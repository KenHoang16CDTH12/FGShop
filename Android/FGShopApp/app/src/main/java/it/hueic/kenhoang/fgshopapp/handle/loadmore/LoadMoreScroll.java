package it.hueic.kenhoang.fgshopapp.handle.loadmore;

import androidx.recyclerview.widget.GridLayoutManager;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

/**
 * Created by kenhoang on 13/03/2018.
 */

public class LoadMoreScroll extends RecyclerView.OnScrollListener {
    private static final String TAG = LoadMoreScroll.class.getName();
    int itemHideFirst = 0;
    int sumItem = 0;
    int itemLoaded = 10;
    ILoadMore iLoadMore;

    RecyclerView.LayoutManager layoutManager;

    public LoadMoreScroll(RecyclerView.LayoutManager layoutManager, ILoadMore iLoadMore) {
        this.layoutManager = layoutManager;
        this.iLoadMore = iLoadMore;
    }

    @Override
    public void onScrolled(RecyclerView recyclerView, int dx, int dy) {
        super.onScrolled(recyclerView, dx, dy);

        sumItem = layoutManager.getItemCount();

        if (layoutManager instanceof LinearLayoutManager) {
            itemHideFirst = ((LinearLayoutManager) layoutManager).findFirstVisibleItemPosition();
        }
        else if (layoutManager instanceof GridLayoutManager) {
            itemHideFirst = ((GridLayoutManager) layoutManager).findFirstVisibleItemPosition();
        }

        if (sumItem <= (itemHideFirst + itemLoaded)) {
            iLoadMore.loadMore(sumItem);
        }

    }

    @Override
    public void onScrollStateChanged(RecyclerView recyclerView, int newState) {
        super.onScrollStateChanged(recyclerView, newState);
    }
}
