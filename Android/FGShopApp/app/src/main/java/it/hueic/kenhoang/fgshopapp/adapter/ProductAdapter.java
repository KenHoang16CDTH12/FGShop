package it.hueic.kenhoang.fgshopapp.adapter;

import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import androidx.recyclerview.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import com.valdesekamdem.library.mdtoast.MDToast;

import java.text.DecimalFormat;
import java.text.NumberFormat;
import java.util.List;

import it.hueic.kenhoang.fgshopapp.adapter.viewholder.ProductHolder;
import it.hueic.kenhoang.fgshopapp.common.Common;
import it.hueic.kenhoang.fgshopapp.handle.click.IClickItemListener;
import it.hueic.kenhoang.fgshopapp.helper.DatabaseHelper;
import it.hueic.kenhoang.fgshopapp.object.OrderDetail;
import it.hueic.kenhoang.fgshopapp.object.Product;
import it.hueic.kenhoang.fgshopapp.utils.Utils;
import it.hueic.kenhoang.fgshopapp.view.detail.DetailActivity;

public class ProductAdapter extends RecyclerView.Adapter<ProductHolder> {
    Context context;
    List<Product> list;
    int resource;

    public ProductAdapter(Context context, List<Product> list, int resource) {
        this.context = context;
        this.list = list;
        this.resource = resource;
    }

    @Override
    public ProductHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        LayoutInflater layoutInflater = (LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
        View view = layoutInflater.inflate(resource, parent, false);
        return new ProductHolder(view);
    }

    @Override
    public void onBindViewHolder(final ProductHolder holder, int position) {
        final Product object = list.get(position);
        holder.name.setText(object.getName_product());
        NumberFormat numberFormat = new DecimalFormat("###,###");
        holder.price.setText(String.valueOf(numberFormat.format(Integer.valueOf(object.getPrice())) + " VND"));
        holder.ratingBar.setRating(object.getRate());
        holder.rate_number.setText("(" + String.valueOf(object.getNum_people_rates()) + ")");
        holder.like_number.setText(String.valueOf(object.getNum_likes()));

        Utils.loadImage(context, object.getImage(), holder.image, holder.progress);

        holder.btn_cart.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if (Utils.isLogin()) {
                    OrderDetail orderDetail = new OrderDetail();
                    orderDetail.setId_user(Common.CURRENT_USER.getId());
                    orderDetail.setId_product(object.getId());
                    orderDetail.setQuantity(1);
                    new DatabaseHelper(context).saveCart(orderDetail);
                    Utils.showToastShort(context, "Add to cart success!", MDToast.TYPE_SUCCESS);
                } else {
                    Utils.openLogin((Activity) context);
                }
            }
        });

        holder.setiClickItemListener(new IClickItemListener() {
            @Override
            public void itemClickListener(View view, int position, boolean isLongClick) {
                Intent detailIntent = new Intent(context, DetailActivity.class);
                detailIntent.putExtra("id_product", list.get(position).getId());
                context.startActivity(detailIntent);
            }
        });
    }

    @Override
    public int getItemCount() {
        return list.size();
    }
}
