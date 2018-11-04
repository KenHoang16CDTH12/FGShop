package it.hueic.kenhoang.fgshopapp.view.detail.commom;

import it.hueic.kenhoang.fgshopapp.object.Product;

public interface IViewDetailCommom {
    void fillData(Product product);
    void showError(String message);
}
