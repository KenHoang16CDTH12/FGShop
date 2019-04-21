package it.hueic.kenhoang.fgshopapp.view.detail.overview;

import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.FrameLayout;
import android.widget.ImageView;
import android.widget.RatingBar;
import android.widget.TextView;

import java.text.DecimalFormat;
import java.text.NumberFormat;
import java.util.ArrayList;
import java.util.List;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.fragment.app.Fragment;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;
import it.hueic.kenhoang.fgshopapp.R;
import it.hueic.kenhoang.fgshopapp.adapter.ImageAdapter;
import it.hueic.kenhoang.fgshopapp.common.Common;
import it.hueic.kenhoang.fgshopapp.object.Product;
import it.hueic.kenhoang.fgshopapp.presenter.detail.commom.PresenterLogicDetailCommom;
import it.hueic.kenhoang.fgshopapp.presenter.detail.overview.PresenterLogicOverview;
import it.hueic.kenhoang.fgshopapp.utils.Utils;
import it.hueic.kenhoang.fgshopapp.view.detail.commom.IViewDetailCommom;


public class FragmentOverview extends Fragment implements
        IViewDetailCommom,
        IFragmentOverview{
    private static final String TAG = FragmentOverview.class.getSimpleName();
    RecyclerView recycler_img;
    FrameLayout btnFavorite, btnShare;
    ImageView imgFav;
    TextView tvIndex, name, price, rateNumber, likeNumber;
    RatingBar ratingBar;
    List<String> paths;
    LinearLayoutManager layoutManager;
    ImageAdapter adapter;
    int id_product = 0;
    PresenterLogicDetailCommom presenterLogicCommom;
    PresenterLogicOverview presenterLogicOverview;
    @Nullable
    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.fragment_overview, container, false);
        if (getActivity().getIntent() != null) {
            id_product = getActivity().getIntent().getIntExtra("id_product", 0);
        }
        //Init Presenter
        presenterLogicCommom = new PresenterLogicDetailCommom(this);
        presenterLogicOverview = new PresenterLogicOverview(this);
        //Init View
        initView(view);
        presenterLogicCommom.fillData(id_product);

        if (Utils.isLogin()) presenterLogicOverview.isFavorite(Common.CURRENT_USER.getToken(), id_product, Common.CURRENT_USER.getId());
        else presenterLogicOverview.isFavorite("null", id_product, 0);

        recycler_img.addOnScrollListener(new RecyclerView.OnScrollListener() {
            @Override
            public void onScrolled(RecyclerView recyclerView, int dx, int dy) {
            super.onScrolled(recyclerView, dx, dy);
                int currentFirstVisible = layoutManager.findFirstVisibleItemPosition();
                if (adapter != null) tvIndex.setText((currentFirstVisible + 1) + "/" + adapter.getItemCount());
                else tvIndex.setText("0/0");
            }
        });
        btnFavorite.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if (Utils.isLogin()) {
                    presenterLogicOverview.doFavorite(Common.CURRENT_USER.getToken(), id_product, Common.CURRENT_USER.getId());
                    presenterLogicCommom.fillData(id_product);
                } else {
                    Utils.openLogin(getActivity());
                }
            }
        });
        return view;
    }

    private void initView(View view) {
        recycler_img = view.findViewById(R.id.recycler_img);
        btnFavorite = view.findViewById(R.id.btnFavorite);
        btnShare = view.findViewById(R.id.btnShare);
        tvIndex = view.findViewById(R.id.tvIndex);
        name = view.findViewById(R.id.name);
        price = view.findViewById(R.id.price);
        rateNumber = view.findViewById(R.id.rateNumber);
        likeNumber = view.findViewById(R.id.like);
        ratingBar = view.findViewById(R.id.ratingBar);
        imgFav = view.findViewById(R.id.imgFav);

        layoutManager
                = new LinearLayoutManager(getContext(), LinearLayoutManager.HORIZONTAL, false);
        recycler_img.setLayoutManager(layoutManager);
    }

    @Override
    public void fillData(Product product) {
        name.setText(product.getName_product().toString());
        NumberFormat numberFormat = new DecimalFormat("###,###");
        price.setText(String.valueOf(numberFormat.format(Integer.valueOf(product.getPrice())) + " VND"));
        ratingBar.setRating(product.getRate());
        rateNumber.setText("(" + String.valueOf(product.getNum_people_rates()) + ")");
        likeNumber.setText(String.valueOf(product.getNum_likes()));

        paths = new ArrayList<>();
        paths.add(product.getImage());
        paths.add(product.getBrand().getImage());
        adapter = new ImageAdapter(getContext(), paths, R.layout.item_image);
        recycler_img.setAdapter(adapter);
        adapter.notifyDataSetChanged();
    }

    @Override
    public void showError(String message) {

    }

    @Override
    public void isFavorite(String message) {
        if (message.equals("Favorite")) {
            imgFav.setImageResource(R.drawable.ic_favorite_black_24dp);
        } else {
            imgFav.setImageResource(R.drawable.ic_favorite_border_black_24dp);
        }
    }
}
