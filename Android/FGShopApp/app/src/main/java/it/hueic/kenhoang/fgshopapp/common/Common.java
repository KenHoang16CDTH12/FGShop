package it.hueic.kenhoang.fgshopapp.common;

import it.hueic.kenhoang.fgshopapp.object.User;

public class Common {
    //Current
    public static User CURRENT_USER;
    //Local of genymotion 10.0.3.2
    //Local of Android emulator 10.0.2.2
    //Local of Android real (You need connect common wifi) - You use local of desktop
    //http://localhost/mvc/FGShop/api.php
    //http://ineovn.000webhostapp.com (Host test)
    public static final String SERVER_NAME = "http://192.168.1.5/mvc/FGShop";
    public static final String URL = SERVER_NAME + "/";
    public static final String URL_API = URL + "api.php";
    public static final String URL_API_TOKEN = Common.URL_API + "?token=";
    //APIs
    //controller
    public static final String USER = "User";
    public static final String GROUP_PRODUCT_TYPE = "GroupProductType";
    public static final String PRODUCT_TYPE = "ProductType";
    public static final String PRODUCT = "Product";
    public static final String BANNER = "Banner";
    public static final String RATING = "Rating";
    public static final String FAVORITE = "Favorite";
    public static final String ORDER = "Order";
    //action
    public static final String INDEX = "index";
    public static final String LOGIN = "login";
    public static final String LOGOUT = "logout";
    public static final String REGISTER = "register";
    public static final String EXISTS = "exists";
    public static final String GROUP = "group";
    public static final String GROUP_DETAIL = "group_detail";
    public static final String REQUEST = "request";
    public static final String DETAIL = "detail";
    public static final String STORE = "store";
    public static final String CHECK = "check";

    //DEFAULT DATA
    public static final String ADMIN = "ADMIN";
    public static final String PARTNER = "PARTNER";
    public static final String CLIENT = "CLIENT";

    public static final String BIRTHDATE_DEFAULT = "01/01/1990";
    public static final int DELAY_TIME = 3000;
    public static final String USERNAME_KEY = "username";
    public static final String PASSWORD_KEY = "password";

    //DEFAULT STATUS ORDER
    public static final String PLACED = "PLACED";
    public static final String SHIPPED = "SHIPPED";
    public static final String ON_MY_WAY = "ON_MY_WAY";
    //DEFAULT ARRAY
    public static String[] TITLE_FRAGMENT_LOGIN = {
            "Sign In",
            "Sign Up"
    };

    public static String[] TITLE_FRAGMENT_DETAIL = {
            "Overview",
            "Ranking",
            "Detail"
    };
}
