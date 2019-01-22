package it.hueic.kenhoang.fgshopapp.model;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.concurrent.ExecutionException;

import it.hueic.kenhoang.fgshopapp.common.Common;
import it.hueic.kenhoang.fgshopapp.connect.ConnectAPI;
import it.hueic.kenhoang.fgshopapp.helper.ParseHelper;
import it.hueic.kenhoang.fgshopapp.object.Order;
import it.hueic.kenhoang.fgshopapp.object.OrderDetail;
import it.hueic.kenhoang.fgshopapp.object.ProductType;

public class ModelOrder {
    /**
     * controller: Order
     * action: group
     * @return
     */
    public List<Order> orders(String token, int id_user) {
        String data = "";
        int status = 0;

        List<Order> list = new ArrayList<>();

        List<HashMap<String, String>> attrs = new ArrayList<>();

        HashMap<String, String> attr = new HashMap<>();

        attr.put("controller", Common.ORDER);
        attrs.add(attr);

        attr = new HashMap<>();
        attr.put("action", Common.GROUP);
        attrs.add(attr);

        attr = new HashMap<>();
        attr.put("token", token);
        attrs.add(attr);

        attr = new HashMap<>();
        attr.put("id_user", String.valueOf(id_user));
        attrs.add(attr);

        ConnectAPI connect = new ConnectAPI(Common.URL_API, attrs);
        connect.execute();
        try {
            data = connect.get().get(0);
            status = Integer.parseInt(connect.get().get(1));
            list = ParseHelper.parseOrders(data, status);
        } catch (InterruptedException e) {
            e.printStackTrace();
        } catch (ExecutionException e) {
            e.printStackTrace();
        }
        return list;
    }

    /**
     * controller: Order
     * action: group
     * @return
     */
    public List<OrderDetail> orderDetails(String token, int id_order) {
        String data = "";
        int status = 0;

        List<OrderDetail> list = new ArrayList<>();

        List<HashMap<String, String>> attrs = new ArrayList<>();

        HashMap<String, String> attr = new HashMap<>();

        attr.put("controller", Common.ORDER);
        attrs.add(attr);

        attr = new HashMap<>();
        attr.put("action", Common.GROUP_DETAIL);
        attrs.add(attr);

        attr = new HashMap<>();
        attr.put("token", token);
        attrs.add(attr);

        attr = new HashMap<>();
        attr.put("id_order", String.valueOf(id_order));
        attrs.add(attr);

        ConnectAPI connect = new ConnectAPI(Common.URL_API, attrs);
        connect.execute();
        try {
            data = connect.get().get(0);
            status = Integer.parseInt(connect.get().get(1));
            list = ParseHelper.parseOrderDetails(data, status);
        } catch (InterruptedException e) {
            e.printStackTrace();
        } catch (ExecutionException e) {
            e.printStackTrace();
        }
        return list;
    }
}
