package it.hueic.kenhoang.fgshopapp.adapter.viewholder;

import android.support.v7.widget.RecyclerView;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.ProgressBar;
import android.widget.RatingBar;
import android.widget.TextView;

import it.hueic.kenhoang.fgshopapp.R;
import it.hueic.kenhoang.fgshopapp.handle.click.IClickItemListener;

public class ProductHolder extends RecyclerView.ViewHolder implements View.OnClickListener {
    public ProgressBar progress;
    public TextView name, price, rate_number, like_number;
    public ImageView image;
    public RatingBar ratingBar;
    public Button btn_cart;
    public IClickItemListener iClickItemListener;
    public ProductHolder(View itemView) {
        super(itemView);
        progress = itemView.findViewById(R.id.progress);
        name = itemView.findViewById(R.id.name);
        image = itemView.findViewById(R.id.image);
        price = itemView.findViewById(R.id.price);
        rate_number = itemView.findViewById(R.id.rateNumber);
        like_number = itemView.findViewById(R.id.like);
        ratingBar = itemView.findViewById(R.id.rating);
        btn_cart = itemView.findViewById(R.id.btnQuickCart);
        itemView.setOnClickListener(this);
    }

    public void setiClickItemListener(IClickItemListener iClickItemListener) {
        this.iClickItemListener = iClickItemListener;
    }

    @Override
    public void onClick(View v) {
        iClickItemListener.itemClickListener(v, getAdapterPosition(), false);
    }
}
