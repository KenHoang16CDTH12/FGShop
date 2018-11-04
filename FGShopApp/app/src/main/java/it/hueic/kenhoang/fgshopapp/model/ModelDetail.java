package it.hueic.kenhoang.fgshopapp.model;

import android.util.Log;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.concurrent.ExecutionException;

import it.hueic.kenhoang.fgshopapp.common.Common;
import it.hueic.kenhoang.fgshopapp.connect.ConnectAPI;
import it.hueic.kenhoang.fgshopapp.helper.ParseHelper;
import it.hueic.kenhoang.fgshopapp.object.Product;
import it.hueic.kenhoang.fgshopapp.object.Rate;

public class ModelDetail {

    private static final String TAG = ModelDetail.class.getName();

    /**
     * Product with id
     * @param id_product
     * @return
     */
    public Product findById(int id_product) {
        Product product = new Product();
        String data = "";
        int status = 0;

        List<HashMap<String,String>> attrs = new ArrayList<>();

        HashMap<String, String> hashMap = new HashMap<>();
        hashMap.put("controller", Common.PRODUCT);
        attrs.add(hashMap);

        hashMap = new HashMap<>();
        hashMap.put("action", Common.DETAIL);
        attrs.add(hashMap);

        hashMap = new HashMap<>();
        hashMap.put("id_product", String.valueOf(id_product));
        attrs.add(hashMap);

        ConnectAPI connect = new ConnectAPI(Common.URL_API, attrs);
        connect.execute();
        try {
            data = connect.get().get(0);
            status = Integer.parseInt(connect.get().get(1));
            product = ParseHelper.parseProduct(data, status);
        } catch (InterruptedException e) {
            e.printStackTrace();
        } catch (ExecutionException e) {
            e.printStackTrace();
        }
        return product;
    }

    /**
     * controller: Rating
     * action: group
     * @return
     */
    public List<Rate> rates(int id_product, int limit) {
        String data = "";
        int status = 0;

        List<Rate> list = new ArrayList<>();

        List<HashMap<String, String>> attrs = new ArrayList<>();

        HashMap<String, String> attr = new HashMap<>();

        attr.put("controller", Common.RATING);
        attrs.add(attr);

        attr = new HashMap<>();
        attr.put("action", Common.GROUP);
        attrs.add(attr);

        attr = new HashMap<>();
        attr.put("id_product", String.valueOf(id_product));
        attrs.add(attr);

        attr = new HashMap<>();
        attr.put("limit", String.valueOf(limit));
        attrs.add(attr);

        ConnectAPI connect = new ConnectAPI(Common.URL_API, attrs);
        connect.execute();
        try {
            data = connect.get().get(0);
            status = Integer.parseInt(connect.get().get(1));
            list = ParseHelper.parseRates(data, status);
        } catch (InterruptedException e) {
            e.printStackTrace();
        } catch (ExecutionException e) {
            e.printStackTrace();
        }
        return list;
    }

    /**
     * controller: Rating
     * action: store
     * @return
     */
    public int store(String token, int id_product, int id_user, String content, float stars, String time_rate) {
        String data = "";
        int status = 0;

        List<HashMap<String, String>> attrs = new ArrayList<>();

        HashMap<String, String> attr = new HashMap<>();

        attr.put("controller", Common.RATING);
        attrs.add(attr);

        attr = new HashMap<>();
        attr.put("action", Common.STORE);
        attrs.add(attr);

        attr = new HashMap<>();
        attr.put("token", token);
        attrs.add(attr);

        attr = new HashMap<>();
        attr.put("id_product", String.valueOf(id_product));
        attrs.add(attr);

        attr = new HashMap<>();
        attr.put("id_user", String.valueOf(id_user));
        attrs.add(attr);

        attr = new HashMap<>();
        attr.put("content", content);
        attrs.add(attr);

        attr = new HashMap<>();
        attr.put("stars", String.valueOf(stars));
        attrs.add(attr);

        attr = new HashMap<>();
        attr.put("time_rate", time_rate);
        attrs.add(attr);

        ConnectAPI connect = new ConnectAPI(Common.URL_API, attrs);
        connect.execute();
        try {
            data = connect.get().get(0);
            Log.d(TAG, "store: ");
            status = Integer.parseInt(connect.get().get(1));
        } catch (InterruptedException e) {
            e.printStackTrace();
        } catch (ExecutionException e) {
            e.printStackTrace();
        }
        return status;
    }

    /**
     * controller: Favorite
     * action: store
     * @return
     */
    public String favorite(String token, int id_product, int id_user) {
        String data = "";
        int status = 0;
        String message = "";

        List<HashMap<String, String>> attrs = new ArrayList<>();

        HashMap<String, String> attr = new HashMap<>();

        attr.put("controller", Common.FAVORITE);
        attrs.add(attr);

        attr = new HashMap<>();
        attr.put("action", Common.STORE);
        attrs.add(attr);

        attr = new HashMap<>();
        attr.put("token", token);
        attrs.add(attr);

        attr = new HashMap<>();
        attr.put("id_product", String.valueOf(id_product));
        attrs.add(attr);

        attr = new HashMap<>();
        attr.put("id_user", String.valueOf(id_user));
        attrs.add(attr);

        ConnectAPI connect = new ConnectAPI(Common.URL_API, attrs);
        connect.execute();
        try {
            data = connect.get().get(0);
            Log.d(TAG, "store: ");
            status = Integer.parseInt(connect.get().get(1));
            message = ParseHelper.parseFavorite(data, status);
        } catch (InterruptedException e) {
            e.printStackTrace();
        } catch (ExecutionException e) {
            e.printStackTrace();
        }
        return message;
    }

    /**
     * controller: Favorite
     * action: check
     * @return
     */
    public String checkFavorite(String token, int id_product, int id_user) {
        String data = "";
        int status = 0;
        String message = "";

        List<HashMap<String, String>> attrs = new ArrayList<>();

        HashMap<String, String> attr = new HashMap<>();

        attr.put("controller", Common.FAVORITE);
        attrs.add(attr);

        attr = new HashMap<>();
        attr.put("action", Common.CHECK);
        attrs.add(attr);

        attr = new HashMap<>();
        attr.put("token", token);
        attrs.add(attr);

        attr = new HashMap<>();
        attr.put("id_product", String.valueOf(id_product));
        attrs.add(attr);

        attr = new HashMap<>();
        attr.put("id_user", String.valueOf(id_user));
        attrs.add(attr);

        ConnectAPI connect = new ConnectAPI(Common.URL_API, attrs);
        connect.execute();
        try {
            data = connect.get().get(0);
            Log.d(TAG, "store: ");
            status = Integer.parseInt(connect.get().get(1));
            message = ParseHelper.parseFavorite(data, status);
        } catch (InterruptedException e) {
            e.printStackTrace();
        } catch (ExecutionException e) {
            e.printStackTrace();
        }
        return message;
    }
}
