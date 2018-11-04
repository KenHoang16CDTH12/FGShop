package it.hueic.kenhoang.fgshopapp.view.product;

import java.util.List;

import it.hueic.kenhoang.fgshopapp.object.Product;
import it.hueic.kenhoang.fgshopapp.object.ProductType;

public interface IViewProduct {
    void menus(List<ProductType> lists);
    void products(List<Product> products);
    void emptyProduct();
}
