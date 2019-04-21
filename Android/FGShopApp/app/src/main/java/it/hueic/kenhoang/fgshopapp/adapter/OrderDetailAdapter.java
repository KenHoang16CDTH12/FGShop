package it.hueic.kenhoang.fgshopapp.adapter;

import android.content.Context;
import android.graphics.Color;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import com.amulyakhare.textdrawable.TextDrawable;

import java.text.DecimalFormat;
import java.text.NumberFormat;
import java.util.List;

import androidx.recyclerview.widget.RecyclerView;
import it.hueic.kenhoang.fgshopapp.adapter.viewholder.OrderDetailHolder;
import it.hueic.kenhoang.fgshopapp.model.ModelDetail;
import it.hueic.kenhoang.fgshopapp.object.OrderDetail;
import it.hueic.kenhoang.fgshopapp.object.Product;
import it.hueic.kenhoang.fgshopapp.utils.Utils;

public class OrderDetailAdapter extends RecyclerView.Adapter<OrderDetailHolder> {
    Context context;
    private List<OrderDetail> list;
    int resource;

    public OrderDetailAdapter(Context context, List<OrderDetail> list, int resource) {
        this.context = context;
        this.list = list;
        this.resource = resource;
    }

    @Override
    public OrderDetailHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        LayoutInflater layoutInflater = (LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
        View view = layoutInflater.inflate(resource, parent, false);
        return new OrderDetailHolder(view);
    }

    @Override
    public void onBindViewHolder(final OrderDetailHolder holder, final int position) {
        OrderDetail orderDetail = list.get(position);
        TextDrawable drawable = TextDrawable.builder()
                .buildRect(String.valueOf(orderDetail.getQuantity()), Color.RED);
        holder.product_count.setImageDrawable(drawable);
        ModelDetail modelDetail = new ModelDetail();
        Product product = modelDetail.findById(list.get(position).getId_product());
        final NumberFormat numberFormat = new DecimalFormat("###,###");
        int price = Integer.valueOf(product.getPrice())  * orderDetail.getQuantity();
        holder.price.setText(String.valueOf(numberFormat.format(price) + " VND"));
        holder.name.setText(product.getName_product());
        Utils.loadImage(context, product.getImage(), holder.img, holder.progress);
    }

    @Override
    public int getItemCount() {
        return list.size();
    }
}
