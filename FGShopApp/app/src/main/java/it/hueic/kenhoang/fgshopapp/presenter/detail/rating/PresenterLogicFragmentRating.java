package it.hueic.kenhoang.fgshopapp.presenter.detail.rating;

import android.view.View;
import android.widget.ProgressBar;

import java.util.List;

import it.hueic.kenhoang.fgshopapp.model.ModelDetail;
import it.hueic.kenhoang.fgshopapp.object.Rate;
import it.hueic.kenhoang.fgshopapp.view.detail.rating.IViewFragmentRating;

public class PresenterLogicFragmentRating implements IPresenterFragmentRating {
    IViewFragmentRating view;
    ModelDetail model;

    public PresenterLogicFragmentRating(IViewFragmentRating view) {
        this.view = view;
        model = new ModelDetail();
    }

    @Override
    public void rates(int id_product) {
        List<Rate> list = model.rates(id_product, 0);
        if (!list.isEmpty() && list != null) view.rates(list);
    }

    @Override
    public List<Rate> loadMoreRates(int id_product, int sumItem, ProgressBar progress) {
        progress.setVisibility(View.VISIBLE);
        List<Rate> rates = model.rates(id_product, sumItem);
        if (!rates.isEmpty()) progress.setVisibility(View.GONE);
        return rates;
    }
}
