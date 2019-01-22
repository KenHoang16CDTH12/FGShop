package it.hueic.kenhoang.fgshopapp.model;

import android.util.Log;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.concurrent.ExecutionException;

import it.hueic.kenhoang.fgshopapp.common.Common;
import it.hueic.kenhoang.fgshopapp.connect.ConnectAPI;
import it.hueic.kenhoang.fgshopapp.helper.ParseHelper;

public class ModelCheckout {

    private static final String TAG = ModelDetail.class.getName();

    /**
     * controller: Order
     * action: request
     * @return
     */
    public int request(String token, int id_user, String status_order, String phone, String delivery_address, String order_date, String desc) {
        String data = "";
        int status = 0;
        int id_order = 0;

        List<HashMap<String, String>> attrs = new ArrayList<>();

        HashMap<String, String> attr = new HashMap<>();

        attr.put("controller", Common.ORDER);
        attrs.add(attr);

        attr = new HashMap<>();
        attr.put("action", Common.REQUEST);
        attrs.add(attr);

        attr = new HashMap<>();
        attr.put("token", token);
        attrs.add(attr);

        attr = new HashMap<>();
        attr.put("id_user", String.valueOf(id_user));
        attrs.add(attr);

        attr = new HashMap<>();
        attr.put("status", status_order);
        attrs.add(attr);

        attr = new HashMap<>();
        attr.put("phone", phone);
        attrs.add(attr);

        attr = new HashMap<>();
        attr.put("delivery_address", delivery_address);
        attrs.add(attr);

        attr = new HashMap<>();
        attr.put("order_date", order_date);
        attrs.add(attr);

        attr = new HashMap<>();
        attr.put("desc", desc);
        attrs.add(attr);

        ConnectAPI connect = new ConnectAPI(Common.URL_API, attrs);
        connect.execute();
        try {
            data = connect.get().get(0);
            Log.d(TAG, "store: ");
            status = Integer.parseInt(connect.get().get(1));
            id_order = ParseHelper.parseOrderId(data, status);
        } catch (InterruptedException e) {
            e.printStackTrace();
        } catch (ExecutionException e) {
            e.printStackTrace();
        }
        return id_order;
    }

    /**
     * controller: Order
     * action: store
     * @return
     */
    public int store(String token, int id_order, int id_product, int quanity) {
        String data = "";
        int status = 0;

        List<HashMap<String, String>> attrs = new ArrayList<>();

        HashMap<String, String> attr = new HashMap<>();

        attr.put("controller", Common.ORDER);
        attrs.add(attr);

        attr = new HashMap<>();
        attr.put("action", Common.STORE);
        attrs.add(attr);

        attr = new HashMap<>();
        attr.put("token", token);
        attrs.add(attr);

        attr = new HashMap<>();
        attr.put("id_order", String.valueOf(id_order));
        attrs.add(attr);

        attr = new HashMap<>();
        attr.put("id_product", String.valueOf(id_product));
        attrs.add(attr);

        attr = new HashMap<>();
        attr.put("quanity", String.valueOf(quanity));
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
}
