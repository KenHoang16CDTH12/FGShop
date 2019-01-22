package it.hueic.kenhoang.fgshopapp.adapter;

import android.content.Context;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import com.squareup.picasso.Callback;
import com.squareup.picasso.Picasso;

import java.util.List;

import it.hueic.kenhoang.fgshopapp.adapter.viewholder.ImageHolder;
import it.hueic.kenhoang.fgshopapp.common.Common;
import it.hueic.kenhoang.fgshopapp.utils.Utils;

public class ImageAdapter extends RecyclerView.Adapter<ImageHolder> {
    Context context;
    List<String> list;
    int resource;

    public ImageAdapter(Context context, List<String> list, int resource) {
        this.context = context;
        this.list = list;
        this.resource = resource;
    }

    @Override
    public ImageHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        LayoutInflater layoutInflater = (LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
        View view = layoutInflater.inflate(resource, parent, false);
        return new ImageHolder(view);
    }

    @Override
    public void onBindViewHolder(final ImageHolder holder, int position) {
        final String path = list.get(position);

        Utils.loadImage(context, path, holder.img, holder.progress);
    }

    @Override
    public int getItemCount() {
        return list.size();
    }
}
