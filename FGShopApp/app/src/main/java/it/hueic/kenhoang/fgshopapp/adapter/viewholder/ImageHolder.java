package it.hueic.kenhoang.fgshopapp.adapter.viewholder;

import android.support.v7.widget.RecyclerView;
import android.view.View;
import android.widget.ImageView;
import android.widget.ProgressBar;

import it.hueic.kenhoang.fgshopapp.R;

public class ImageHolder extends RecyclerView.ViewHolder{
    public ImageView img;
    public ProgressBar progress;
    public ImageHolder(View itemView) {
        super(itemView);
        img = itemView.findViewById(R.id.img);
        progress = itemView.findViewById(R.id.progress);
    }
}
