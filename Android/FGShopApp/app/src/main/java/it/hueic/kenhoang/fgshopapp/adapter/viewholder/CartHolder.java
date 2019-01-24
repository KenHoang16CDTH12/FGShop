package it.hueic.kenhoang.fgshopapp.adapter.viewholder;

import androidx.recyclerview.widget.RecyclerView;

import android.view.View;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.ProgressBar;
import android.widget.RelativeLayout;
import android.widget.TextView;

import com.cepheuen.elegantnumberbutton.view.ElegantNumberButton;

import it.hueic.kenhoang.fgshopapp.R;

public class CartHolder extends RecyclerView.ViewHolder{
    public TextView name, price;
    public ImageView img;
    public ElegantNumberButton btnQuantity;
    public RelativeLayout view_background;
    public LinearLayout view_foreground;
    public ProgressBar progress;
    public CartHolder(View itemView) {
        super(itemView);
        name = itemView.findViewById(R.id.name);
        price = itemView.findViewById(R.id.price);
        img = itemView.findViewById(R.id.img);
        btnQuantity = itemView.findViewById(R.id.btnQuantity);
        progress = itemView.findViewById(R.id.progress);
        view_background = itemView.findViewById(R.id.view_background);
        view_foreground = itemView.findViewById(R.id.view_foreground);
    }

}

