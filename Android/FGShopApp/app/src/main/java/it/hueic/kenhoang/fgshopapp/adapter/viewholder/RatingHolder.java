package it.hueic.kenhoang.fgshopapp.adapter.viewholder;

import androidx.recyclerview.widget.RecyclerView;
import android.view.View;
import android.widget.ImageView;
import android.widget.ProgressBar;
import android.widget.RatingBar;
import android.widget.TextView;

import it.hueic.kenhoang.fgshopapp.R;

public class RatingHolder extends RecyclerView.ViewHolder {
    public TextView name, time, comment;
    public ImageView img;
    public RatingBar ratingBar;
    public ProgressBar progress;

    public RatingHolder(View itemView) {
        super(itemView);
        name = itemView.findViewById(R.id.name);
        time = itemView.findViewById(R.id.time);
        comment = itemView.findViewById(R.id.comment);
        img = itemView.findViewById(R.id.img);
        ratingBar = itemView.findViewById(R.id.ratingBar);
        progress = itemView.findViewById(R.id.progress);
    }
}
