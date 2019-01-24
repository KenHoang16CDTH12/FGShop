package it.hueic.kenhoang.fgshopapp.adapter;

import android.content.Context;
import androidx.recyclerview.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import java.util.List;

import it.hueic.kenhoang.fgshopapp.R;
import it.hueic.kenhoang.fgshopapp.adapter.viewholder.RatingHolder;
import it.hueic.kenhoang.fgshopapp.object.Rate;
import it.hueic.kenhoang.fgshopapp.utils.Utils;

public class RatingAdapter extends RecyclerView.Adapter<RatingHolder> {
    Context context;
    List<Rate> list;
    int resource;

    public RatingAdapter(Context context, List<Rate> list, int resource) {
        this.context = context;
        this.list = list;
        this.resource = resource;
    }

    @Override
    public RatingHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        LayoutInflater layoutInflater = (LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
        View view = layoutInflater.inflate(resource, parent, false);
        return new RatingHolder(view);
    }

    @Override
    public void onBindViewHolder(final RatingHolder holder, int position) {
        final Rate object = list.get(position);
        holder.name.setText(object.getUser().getName());
        holder.comment.setText(object.getContent().trim());
        holder.time.setText(Utils.convertTime(object.getTime_rate()));
        holder.ratingBar.setRating(object.getStars());
        if (object.getUser().getAvatar() != null && !object.getUser().getAvatar().equals("null")) {
            Utils.loadImage(context, object.getUser().getAvatar(), holder.img, holder.progress);
        } else {
            holder.img.setImageResource(R.drawable.image_null);
            holder.progress.setVisibility(View.GONE);
        }
    }

    @Override
    public int getItemCount() {
        return list.size();
    }
}
