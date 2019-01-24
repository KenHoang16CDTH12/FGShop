package it.hueic.kenhoang.fgshopapp.handle.remove;

import android.graphics.Canvas;
import androidx.recyclerview.widget.RecyclerView;
import androidx.recyclerview.widget.ItemTouchHelper;
import android.view.View;

import it.hueic.kenhoang.fgshopapp.adapter.viewholder.CartHolder;

public class RecyclerItemTouchCart extends ItemTouchHelper.SimpleCallback{
    private IRecyclerItemTouch listener;

    public RecyclerItemTouchCart(int dragDirs, int swipeDirs, IRecyclerItemTouch listener) {
        super(dragDirs, swipeDirs);
        this.listener = listener;
    }

    @Override
    public boolean onMove(RecyclerView recyclerView, RecyclerView.ViewHolder viewHolder, RecyclerView.ViewHolder target) {
        return true;
    }

    @Override
    public void onSwiped(RecyclerView.ViewHolder viewHolder, int direction) {
        if (listener != null)
            listener.onSwiped(viewHolder, direction, viewHolder.getAdapterPosition());
    }

    @Override
    public int convertToAbsoluteDirection(int flags, int layoutDirection) {
        return super.convertToAbsoluteDirection(flags, layoutDirection);
    }

    @Override
    public void clearView(RecyclerView recyclerView, RecyclerView.ViewHolder viewHolder) {
        View foregroundView = ((CartHolder) viewHolder).view_foreground;
        getDefaultUIUtil().clearView(foregroundView);
    }

    @Override
    public void onChildDraw(Canvas c, RecyclerView recyclerView, RecyclerView.ViewHolder viewHolder, float dX, float dY, int actionState, boolean isCurrentlyActive) {
        View  foregroundView = ((CartHolder) viewHolder).view_foreground;
        getDefaultUIUtil().onDraw(c, recyclerView, foregroundView, dX, dY, actionState, isCurrentlyActive);
    }

    @Override
    public void onSelectedChanged(RecyclerView.ViewHolder viewHolder, int actionState) {
        if (viewHolder != null) {
            View  foregroundView = ((CartHolder) viewHolder).view_foreground;
            getDefaultUIUtil().onSelected(foregroundView);
        }
    }

    @Override
    public void onChildDrawOver(Canvas c, RecyclerView recyclerView, RecyclerView.ViewHolder viewHolder, float dX, float dY, int actionState, boolean isCurrentlyActive) {
        View  foregroundView = ((CartHolder) viewHolder).view_foreground;
        getDefaultUIUtil().onDrawOver(c, recyclerView, foregroundView, dX, dY, actionState, isCurrentlyActive);
    }
}
