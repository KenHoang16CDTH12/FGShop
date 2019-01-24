package it.hueic.kenhoang.fgshopapp.adapter.viewholder;

import androidx.recyclerview.widget.RecyclerView;
import android.view.View;
import android.widget.ImageView;
import android.widget.ProgressBar;
import android.widget.TextView;

import it.hueic.kenhoang.fgshopapp.R;
import it.hueic.kenhoang.fgshopapp.handle.click.IClickItemListener;

public class GroupProductTypeHolder extends RecyclerView.ViewHolder implements View.OnClickListener {
    public ProgressBar progress;
    public TextView name;
    public ImageView image;
    public IClickItemListener iClickItemListener;
    public GroupProductTypeHolder(View itemView) {
        super(itemView);
        progress = itemView.findViewById(R.id.progress);
        name = itemView.findViewById(R.id.name);
        image = itemView.findViewById(R.id.image);
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
