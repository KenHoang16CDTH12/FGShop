package it.hueic.kenhoang.fgshopapp.adapter;

import android.content.Context;
import android.content.Intent;
import androidx.recyclerview.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import java.util.List;

import it.hueic.kenhoang.fgshopapp.adapter.viewholder.OrderHolder;
import it.hueic.kenhoang.fgshopapp.object.Order;
import it.hueic.kenhoang.fgshopapp.view.orderdetail.OrderDetailActivity;

public class OrderAdapter extends RecyclerView.Adapter<OrderHolder> {
    Context context;
    List<Order> list;
    int resource;

    public OrderAdapter(Context context, List<Order> list, int resource) {
        this.context = context;
        this.list = list;
        this.resource = resource;
    }

    @Override
    public OrderHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        LayoutInflater layoutInflater = (LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
        View view = layoutInflater.inflate(resource, parent, false);
        return new OrderHolder(view);
    }

    @Override
    public void onBindViewHolder(final OrderHolder holder, int position) {
        final Order order = list.get(position);
        holder.txtOrderId.setText(String.valueOf("#" + order.getId()));
        holder.txtOrderStatus.setText(String.valueOf(order.getStatus()));
        holder.txtOrderPhone.setText(String.valueOf(order.getPhone()));
        holder.txtOrderAddress.setText(String.valueOf(order.getDelivery_address()));
        //handle event button click
        holder.btnDetail.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent detailIntent = new Intent(context, OrderDetailActivity.class);
                detailIntent.putExtra("id_order", order.getId());
                context.startActivity(detailIntent);
            }
        });

        holder.btnRemove.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

            }
        });
    }

    @Override
    public int getItemCount() {
        return list.size();
    }
}
