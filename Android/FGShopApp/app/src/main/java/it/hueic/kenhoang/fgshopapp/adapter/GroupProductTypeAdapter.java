package it.hueic.kenhoang.fgshopapp.adapter;

import android.content.Context;
import android.content.Intent;
import androidx.recyclerview.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import java.util.List;

import it.hueic.kenhoang.fgshopapp.adapter.viewholder.GroupProductTypeHolder;
import it.hueic.kenhoang.fgshopapp.handle.click.IClickItemListener;
import it.hueic.kenhoang.fgshopapp.object.GroupProductType;
import it.hueic.kenhoang.fgshopapp.utils.Utils;
import it.hueic.kenhoang.fgshopapp.view.product.ProductActivity;

public class GroupProductTypeAdapter extends RecyclerView.Adapter<GroupProductTypeHolder> {
    Context context;
    List<GroupProductType> list;
    int resource;

    public GroupProductTypeAdapter(Context context, List<GroupProductType> list, int resource) {
        this.context = context;
        this.list = list;
        this.resource = resource;
    }

    @Override
    public GroupProductTypeHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        LayoutInflater layoutInflater = (LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
        View view = layoutInflater.inflate(resource, parent, false);
        return new GroupProductTypeHolder(view);
    }

    @Override
    public void onBindViewHolder(final GroupProductTypeHolder holder, int position) {
        final GroupProductType object = list.get(position);
        holder.name.setText(object.getName_group());

        Utils.loadImage(context, object.getImage(), holder.image, holder.progress);

        holder.setiClickItemListener(new IClickItemListener() {
            @Override
            public void itemClickListener(View view, int position, boolean isLongClick) {
                //Start new Activity
                Intent productIntent = new Intent(context, ProductActivity.class);
                productIntent.putExtra("title", list.get(position).getName_group());
                productIntent.putExtra("id_group", list.get(position).getId()); //Send Group Id to new activity
                context.startActivity(productIntent);
            }
        });
    }

    @Override
    public int getItemCount() {
        return list.size();
    }
}
