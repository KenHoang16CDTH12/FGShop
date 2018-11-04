package it.hueic.kenhoang.fgshopapp.helper;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

import it.hueic.kenhoang.fgshopapp.common.Common;
import it.hueic.kenhoang.fgshopapp.object.Banner;
import it.hueic.kenhoang.fgshopapp.object.Brand;
import it.hueic.kenhoang.fgshopapp.object.GroupProductType;
import it.hueic.kenhoang.fgshopapp.object.Order;
import it.hueic.kenhoang.fgshopapp.object.OrderDetail;
import it.hueic.kenhoang.fgshopapp.object.Product;
import it.hueic.kenhoang.fgshopapp.object.ProductType;
import it.hueic.kenhoang.fgshopapp.object.Rate;
import it.hueic.kenhoang.fgshopapp.object.User;

public class ParseHelper {
    /**
     * Parse JSON User (Login|Register)
     * @param data
     * @param status
     * @return
     */
    public static User parseUser(String data, int status, String username, String password) {
        User user = new User();

        if(status == 200) {
            try {
                JSONObject object = new JSONObject(data);
                JSONArray array = object.getJSONArray(Common.USER);
                int length = array.length();
                for (int i = 0; i < length; i++) {
                    JSONObject value = array.getJSONObject(i);
                    user.setToken(value.getString("token"));
                    user.setRole(value.getString("role"));

                    JSONObject data_user = value.getJSONObject("data");
                    user.setId(data_user.getInt("id"));
                    user.setName(data_user.getString("name"));
                    user.setBirthdate(data_user.getString("birthdate"));
                    user.setPhone(data_user.getString("phone"));
                    user.setGender(data_user.getString("gender"));
                    user.setIdentify_number(data_user.getString("identify_number"));
                    user.setWallet(data_user.getInt("wallet"));
                    user.setIs_social(data_user.getString("is_social"));
                    user.setStatus(data_user.getString("status"));

                    JSONObject image = data_user.getJSONObject("image");
                    user.setAvatar(image.getString("avatar"));
                    user.setCover(image.getString("cover"));

                    user.setUsername(username);
                    user.setPassword(password);
                }

            } catch (JSONException e) {
                e.printStackTrace();
            }
        } else if (status == 401) {
            /* If Login => Unauthorized */
            /* If Register => User is exists */
            user = null;
        } else {
            user = null;
        }
        return user;
    }

    /**
     * Parse JSON GroupProductType
     * @param data
     * @param status
     * @return
     */

    public static List<GroupProductType> parseGroupProductTypes(String data, int status) {
        ArrayList<GroupProductType> list = new ArrayList<>();
        JSONObject jsonObject = null;
        try {
            jsonObject = new JSONObject(data);
            JSONArray array = jsonObject.getJSONArray(Common.GROUP_PRODUCT_TYPE);

            if (status == 200) {
                int length = array.length();
                for (int i = 0; i < length; i++) {
                    JSONObject value = (JSONObject) array.get(i);

                    GroupProductType object = new GroupProductType();
                    object.setId(value.getInt("id"));
                    object.setName_group(value.getString("name_group"));
                    object.setImage(value.getString("image"));

                    list.add(object);
                }
            }
        } catch (JSONException e) {
            e.printStackTrace();
        }
        return list;
    }

    /**
     * Parse JSON Banner
     * @param data
     * @param status
     * @return
     */

    public static List<Banner> parseBanners(String data, int status) {
        ArrayList<Banner> list = new ArrayList<>();
        JSONObject jsonObject = null;
        try {
            jsonObject = new JSONObject(data);
            JSONArray array = jsonObject.getJSONArray(Common.BANNER);

            if (status == 200) {
                int length = array.length();
                for (int i = 0; i < length; i++) {
                    JSONObject value = (JSONObject) array.get(i);

                    Banner object = new Banner();
                    object.setId(value.getInt("id"));
                    object.setId_product(value.getInt("id_product"));
                    object.setName_product(value.getString("name_product"));
                    object.setImage(value.getString("image"));

                    list.add(object);
                }
            }
        } catch (JSONException e) {
            e.printStackTrace();
        }
        return list;
    }

    /**
     * Parse JSON ProductType
     * @param data
     * @param status
     * @return
     */

    public static List<ProductType> parseProductTypes(String data, int status) {
        ArrayList<ProductType> list = new ArrayList<>();
        JSONObject jsonObject = null;
        try {
            jsonObject = new JSONObject(data);
            JSONArray array = jsonObject.getJSONArray(Common.PRODUCT_TYPE);

            if (status == 200) {
                int length = array.length();
                for (int i = 0; i < length; i++) {
                    JSONObject value = (JSONObject) array.get(i);

                    ProductType object = new ProductType();
                    object.setId(value.getInt("id"));
                    object.setName_type(value.getString("name_type"));
                    object.setImage(value.getString("image"));
                    object.setId_group(value.getInt("id_group"));

                    list.add(object);
                }
            }
        } catch (JSONException e) {
            e.printStackTrace();
        }
        return list;
    }

    /**
     * Parse JSON Products
     * @param data
     * @param status
     * @return
     */

    public static List<Product> parseProducts(String data, int status) {
        ArrayList<Product> list = new ArrayList<>();
        JSONObject jsonObject = null;
        try {
            jsonObject = new JSONObject(data);
            JSONArray array = jsonObject.getJSONArray(Common.PRODUCT);

            if (status == 200) {
                int length = array.length();
                for (int i = 0; i < length; i++) {
                    JSONObject value = (JSONObject) array.get(i);

                    Product object = new Product();
                    object.setId(value.getInt("id"));
                    object.setName_product(value.getString("name_product"));
                    object.setPrice(value.getString("price"));
                    object.setImage(value.getString("image"));
                    object.setRate(Float.parseFloat(String.valueOf(value.getInt("rate"))));
                    object.setNum_people_rates(value.getInt("num_people_rates"));
                    object.setNum_likes(value.getInt("num_likes"));

                    list.add(object);
                }
            }
        } catch (JSONException e) {
            e.printStackTrace();
        }
        return list;
    }

    /**
     * Parse JSON Product
     * @param data
     * @param status
     * @return
     */

    public static Product parseProduct(String data, int status) {
        Product product = new Product();
        JSONObject jsonObject = null;
        try {
            jsonObject = new JSONObject(data);
            JSONArray array = jsonObject.getJSONArray(Common.PRODUCT);

            if (status == 200) {
                int length = array.length();
                for (int i = 0; i < length; i++) {
                    JSONObject value = (JSONObject) array.get(i);

                    product.setId(value.getInt("id"));
                    product.setName_product(value.getString("name_product"));
                    product.setPrice(value.getString("price"));
                    product.setIsbn(value.getString("isbn"));
                    product.setInfor(value.getString("infor"));
                    product.setDesc(value.getString("desc"));
                    product.setStatus(value.getString("status"));
                    product.setQuanity(value.getInt("quanity"));
                    product.setImage(value.getString("image"));
                    product.setRate(Float.parseFloat(String.valueOf(value.getInt("rate"))));
                    product.setNum_people_rates(value.getInt("num_people_rates"));
                    product.setNum_likes(value.getInt("num_likes"));

                    JSONObject add_by = value.getJSONObject("add_by");
                    User user = new User();
                    user.setId(add_by.getInt("id"));
                    user.setName(add_by.getString("name"));
                    user.setAvatar(add_by.getString("avatar"));

                    product.setAdd_by(user);

                    JSONObject brand_object = value.getJSONObject("brand");
                    Brand brand = new Brand();
                    brand.setId(brand_object.getInt("id"));
                    brand.setName_brand(brand_object.getString("name_brand"));
                    brand.setImage(brand_object.getString("image"));

                    product.setBrand(brand);

                }
            }
        } catch (JSONException e) {
            e.printStackTrace();
        }
        return product;
    }

    /**
     * Parse JSON Rates
     * @param data
     * @param status
     * @return
     */

    public static List<Rate> parseRates(String data, int status) {
        ArrayList<Rate> list = new ArrayList<>();
        JSONObject jsonObject = null;
        try {
            jsonObject = new JSONObject(data);
            JSONArray array = jsonObject.getJSONArray(Common.RATING);

            if (status == 200) {
                int length = array.length();
                for (int i = 0; i < length; i++) {
                    JSONObject value = (JSONObject) array.get(i);

                    Rate object = new Rate();
                    object.setId(value.getInt("id"));
                    object.setId_product(value.getInt("id_product"));


                    JSONObject user = value.getJSONObject("user");
                    User user_object = new User();
                    user_object.setId(user.getInt("id"));
                    user_object.setName(user.getString("name"));
                    user_object.setAvatar(user.getString("avatar"));
                    object.setUser(user_object);

                    object.setStars(Float.parseFloat(value.getString("stars")));
                    object.setContent(value.getString("content"));
                    object.setTime_rate(value.getString("time_rate"));

                    list.add(object);
                }
            }
        } catch (JSONException e) {
            e.printStackTrace();
        }
        return list;
    }

    /**
     * Parse JSON Favorite
     * @param data
     * @param status
     * @return
     */

    public static String parseFavorite(String data, int status) {
        String message = "";
        JSONObject jsonObject = null;
        try {
            jsonObject = new JSONObject(data);
            JSONArray array = jsonObject.getJSONArray(Common.FAVORITE);

            if (status == 200) {
                JSONObject value = (JSONObject) array.get(0);
                message = value.getString("message");
            } else if (status == 401){
                message = "Unauthorized";
            }
        } catch (JSONException e) {
            e.printStackTrace();
        }
        return message;
    }

    /**
     * Parse JSON Order
     * @param data
     * @param status
     * @return
     */

    public static int parseOrderId(String data, int status) {
        int id = 0;
        JSONObject jsonObject = null;
        try {
            jsonObject = new JSONObject(data);
            JSONArray array = jsonObject.getJSONArray(Common.ORDER);

            if (status == 200) {
                JSONObject value = (JSONObject) array.get(0);
                id = value.getInt("id");
            } else if (status == 401){
                id = 0;
            }
        } catch (JSONException e) {
            e.printStackTrace();
        }
        return id;
    }

    /**
     * Parse JSON Order
     * @param data
     * @param status
     * @return
     */

    public static ArrayList<Order> parseOrders(String data, int status) {
        ArrayList<Order> list = new ArrayList<>();
        JSONObject jsonObject = null;
        try {
            jsonObject = new JSONObject(data);
            JSONArray array = jsonObject.getJSONArray(Common.ORDER);

            if (status == 200) {
                int length = array.length();
                for (int i = 0; i < length; i++) {
                    JSONObject value = (JSONObject) array.get(i);

                    Order object = new Order();
                    object.setId(value.getInt("id"));
                    object.setId_user(value.getInt("id_user"));
                    object.setStatus(value.getString("status"));
                    object.setPhone(value.getString("phone"));
                    object.setDelivery_address(value.getString("delivery_address"));
                    object.setDelivery_date(value.getString("delivery_date"));
                    object.setOrder_date(value.getString("order_date"));
                    object.setDesc(value.getString("desc"));

                    list.add(object);
                }
            }
        } catch (JSONException e) {
            e.printStackTrace();
        }
        return list;
    }

    /**
     * Parse JSON Order
     * @param data
     * @param status
     * @return
     */

    public static ArrayList<OrderDetail> parseOrderDetails(String data, int status) {
        ArrayList<OrderDetail> list = new ArrayList<>();
        JSONObject jsonObject = null;
        try {
            jsonObject = new JSONObject(data);
            JSONArray array = jsonObject.getJSONArray(Common.ORDER);

            if (status == 200) {
                int length = array.length();
                for (int i = 0; i < length; i++) {
                    JSONObject value = (JSONObject) array.get(i);

                    OrderDetail object = new OrderDetail();
                    object.setId_order(value.getInt("id_order"));
                    object.setId_product(value.getInt("id_product"));
                    object.setQuantity(value.getInt("quanity"));

                    list.add(object);
                }
            }
        } catch (JSONException e) {
            e.printStackTrace();
        }
        return list;
    }
}
