package it.hueic.kenhoang.fgshopapp.adapter.viewholder;

import android.support.v7.widget.RecyclerView;
import android.view.View;
import android.widget.ImageView;
import android.widget.ProgressBar;
import android.widget.TextView;


import it.hueic.kenhoang.fgshopapp.R;

public class OrderDetailHolder extends RecyclerView.ViewHolder{
    public TextView name, price;
    public ImageView img;
    public ImageView product_count;
    public ProgressBar progress;
    public OrderDetailHolder(View itemView) {
        super(itemView);
        name = itemView.findViewById(R.id.name);
        price = itemView.findViewById(R.id.price);
        img = itemView.findViewById(R.id.img);
        progress = itemView.findViewById(R.id.progress);
        product_count = itemView.findViewById(R.id.cart_item_count);
    }
}
