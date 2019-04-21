package it.hueic.kenhoang.fgshopapp.presenter.detail.rating;

import android.widget.ProgressBar;

import java.util.List;

import it.hueic.kenhoang.fgshopapp.object.Rate;

public interface IPresenterFragmentRating {
    void rates(int id_product);
    List<Rate> loadMoreRates(int id_product, int sumItem, ProgressBar progress);
}
