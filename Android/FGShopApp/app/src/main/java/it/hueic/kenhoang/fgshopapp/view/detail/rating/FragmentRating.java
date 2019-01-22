package it.hueic.kenhoang.fgshopapp.view.detail.rating;

import android.os.Bundle;
import android.support.annotation.NonNull;
import android.support.annotation.Nullable;
import android.support.v4.app.Fragment;
import android.support.v4.widget.SwipeRefreshLayout;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ProgressBar;
import android.widget.RatingBar;
import android.widget.TextView;

import java.util.ArrayList;
import java.util.List;

import it.hueic.kenhoang.fgshopapp.R;
import it.hueic.kenhoang.fgshopapp.adapter.RatingAdapter;
import it.hueic.kenhoang.fgshopapp.handle.loadmore.ILoadMore;
import it.hueic.kenhoang.fgshopapp.handle.loadmore.LoadMoreScroll;
import it.hueic.kenhoang.fgshopapp.object.Product;
import it.hueic.kenhoang.fgshopapp.object.Rate;
import it.hueic.kenhoang.fgshopapp.presenter.detail.commom.PresenterLogicDetailCommom;
import it.hueic.kenhoang.fgshopapp.presenter.detail.rating.PresenterLogicFragmentRating;
import it.hueic.kenhoang.fgshopapp.view.detail.commom.IViewDetailCommom;

public class FragmentRating extends Fragment implements
        IViewFragmentRating,
        IViewDetailCommom,
        ILoadMore {
    private static final String TAG = FragmentRating.class.getSimpleName();

    RecyclerView recycler_rate;
    RecyclerView.LayoutManager layoutManager;

    SwipeRefreshLayout mSwipeRefreshLayout;
    RatingAdapter adapter;
    List<Rate> listRate;
    TextView tvNumberRate;
    RatingBar ratingBar;
    ProgressBar progress;
    PresenterLogicDetailCommom presenterLogicDetailCommom;
    PresenterLogicFragmentRating presenterLogicFragmentRating;
    int id_product = 0;
    @Nullable
    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.fragment_rating, container, false);
        if (getActivity().getIntent() != null) {
            id_product = getActivity().getIntent().getIntExtra("id_product", 0);
        }
        //Init View
        initView(view);
        //Init Presenter
        presenterLogicDetailCommom = new PresenterLogicDetailCommom(this);
        presenterLogicDetailCommom.fillData(id_product);

        presenterLogicFragmentRating = new PresenterLogicFragmentRating(this);

        mSwipeRefreshLayout.post(new Runnable() {
            @Override
            public void run() {
                listRate = new ArrayList<>();
                presenterLogicFragmentRating.rates(id_product);
                presenterLogicDetailCommom.fillData(id_product);
            }
        });
        mSwipeRefreshLayout.setOnRefreshListener(new SwipeRefreshLayout.OnRefreshListener() {
            @Override
            public void onRefresh() {
                listRate = new ArrayList<>();
                presenterLogicFragmentRating.rates(id_product);
                presenterLogicDetailCommom.fillData(id_product);
            }
        });

        recycler_rate.addOnScrollListener(new LoadMoreScroll(layoutManager, this));

        return view;
    }

    private void initView(View view) {
        recycler_rate = view.findViewById(R.id.recycler_rating);
        progress = view.findViewById(R.id.progress);
        layoutManager = new LinearLayoutManager(getContext());
        recycler_rate.setHasFixedSize(true);
        recycler_rate.setLayoutManager(layoutManager);
        mSwipeRefreshLayout = view.findViewById(R.id.swipe_layout);
        mSwipeRefreshLayout.setColorSchemeResources(R.color.colorPrimary,
                android.R.color.holo_green_dark,
                android.R.color.holo_orange_dark,
                android.R.color.holo_blue_dark
        );
        ratingBar = view.findViewById(R.id.ratingBar);
        tvNumberRate = view.findViewById(R.id.numberRate);
    }

    @Override
    public void rates(List<Rate> rates) {
        recycler_rate.setVisibility(View.VISIBLE);
        listRate.clear();
        listRate = rates;
        adapter = new RatingAdapter(getContext(),
                listRate,
                R.layout.item_rating_comment);
        recycler_rate.setAdapter(adapter);
        adapter.notifyDataSetChanged();
        mSwipeRefreshLayout.setRefreshing(false);
    }

    @Override
    public void loadMore(final int sumItem) {
        recycler_rate.post(new Runnable() {
            @Override
            public void run() {
                List<Rate> listMore = presenterLogicFragmentRating.loadMoreRates(id_product, sumItem, progress);
                listRate.addAll(listMore);
                adapter.notifyDataSetChanged();
            }
        });
    }

    @Override
    public void fillData(Product product) {
        ratingBar.setRating(product.getRate());
        tvNumberRate.setText(String.valueOf(product.getNum_people_rates()));
    }

    @Override
    public void showError(String message) {

    }
}
