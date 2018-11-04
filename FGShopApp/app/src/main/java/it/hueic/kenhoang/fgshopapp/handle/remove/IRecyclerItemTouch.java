package it.hueic.kenhoang.fgshopapp.handle.remove;

import android.support.v7.widget.RecyclerView;

public interface IRecyclerItemTouch {
    void onSwiped(RecyclerView.ViewHolder viewHolder, int direction, int position);
}
