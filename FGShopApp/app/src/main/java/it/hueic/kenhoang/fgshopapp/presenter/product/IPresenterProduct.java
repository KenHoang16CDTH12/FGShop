package it.hueic.kenhoang.fgshopapp.presenter.product;

import android.widget.ProgressBar;

import java.util.List;

import it.hueic.kenhoang.fgshopapp.object.Product;

public interface IPresenterProduct {
    void menus(int id_group);
    void products(int id_product_type);
    List<Product> loadMoreProducts(int id_product_type, int sumItem, ProgressBar progress);
}
