package it.hueic.kenhoang.fgshopapp.handle.remove;

import androidx.recyclerview.widget.RecyclerView;

public interface IRecyclerItemTouch {
    void onSwiped(RecyclerView.ViewHolder viewHolder, int direction, int position);
}
