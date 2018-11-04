package it.hueic.kenhoang.fgshopapp.view.cart;

import android.content.Context;
import android.content.Intent;
import android.graphics.Color;
import android.support.design.widget.Snackbar;
import android.support.v4.widget.SwipeRefreshLayout;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.support.v7.widget.Toolbar;
import android.support.v7.widget.helper.ItemTouchHelper;
import android.view.View;
import android.widget.Button;
import android.widget.LinearLayout;
import android.widget.TextView;

import java.text.DecimalFormat;
import java.text.NumberFormat;
import java.util.List;

import it.hueic.kenhoang.fgshopapp.R;
import it.hueic.kenhoang.fgshopapp.adapter.CartAdapter;
import it.hueic.kenhoang.fgshopapp.adapter.viewholder.CartHolder;
import it.hueic.kenhoang.fgshopapp.common.Common;
import it.hueic.kenhoang.fgshopapp.handle.remove.IRecyclerItemTouch;
import it.hueic.kenhoang.fgshopapp.handle.remove.RecyclerItemTouchCart;
import it.hueic.kenhoang.fgshopapp.object.Cart;
import it.hueic.kenhoang.fgshopapp.presenter.cart.PresenterLogicCart;
import it.hueic.kenhoang.fgshopapp.utils.Utils;
import it.hueic.kenhoang.fgshopapp.view.checkout.CheckoutActivity;
import uk.co.chrisjenx.calligraphy.CalligraphyConfig;
import uk.co.chrisjenx.calligraphy.CalligraphyContextWrapper;

public class CartActivity extends AppCompatActivity implements
        IViewCart,
        IRecyclerItemTouch{
    private static final String TAG = CartActivity.class.getSimpleName();

    RecyclerView recycler_cart;
    RecyclerView.LayoutManager mLayoutManager;
    LinearLayout main_layout;
    SwipeRefreshLayout swipeRefreshLayout;
    TextView tvTotal;
    Button btnCheckout;
    PresenterLogicCart presenterLogicCart;
    CartAdapter adapter;
    //Need call this function after you init database
    @Override
    protected void attachBaseContext(Context newBase) {
        super.attachBaseContext(CalligraphyContextWrapper.wrap(newBase));
    }

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        //Notes : add this code before setContentView
        CalligraphyConfig.initDefault(new CalligraphyConfig.Builder()
                .setDefaultFontPath("fonts/font_main.otf")
                .setFontAttrId(R.attr.fontPath)
                .build());
        setContentView(R.layout.activity_cart);
        //InitView
        initView();
        //InitPresenter
        presenterLogicCart = new PresenterLogicCart(this, this);
        presenterLogicCart.total(Common.CURRENT_USER.getId());
        //Swipe to remove
        ItemTouchHelper.SimpleCallback itemSimpleCallback = new RecyclerItemTouchCart(0, ItemTouchHelper.LEFT, this);
        new ItemTouchHelper(itemSimpleCallback).attachToRecyclerView(recycler_cart);
        //Load Data
        swipeRefreshLayout.setOnRefreshListener(new SwipeRefreshLayout.OnRefreshListener() {
            @Override
            public void onRefresh() {
                presenterLogicCart.carts(Common.CURRENT_USER.getId());
            }
        });
        //Default, load for first time
        swipeRefreshLayout.post(new Runnable() {
            @Override
            public void run() {
                presenterLogicCart.carts(Common.CURRENT_USER.getId());
            }
        });
        btnCheckout.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if (Utils.isLogin()) {
                    Intent checkoutIntent = new Intent(CartActivity.this, CheckoutActivity.class);
                    startActivity(checkoutIntent);
                } else {
                    Utils.openLogin(CartActivity.this);
                }
            }
        });
    }

    private void initView() {
        setUpToolbar();
        recycler_cart = findViewById(R.id.recycler_cart);
        recycler_cart.setHasFixedSize(true);
        mLayoutManager = new LinearLayoutManager(this);
        recycler_cart.setLayoutManager(mLayoutManager);
        main_layout = findViewById(R.id.main_layout);
        tvTotal = findViewById(R.id.total);
        btnCheckout = findViewById(R.id.btnCheckout);
        //SwipeRefresh Layout
        swipeRefreshLayout = findViewById(R.id.swipe_layout);
        swipeRefreshLayout.setColorSchemeResources(R.color.colorPrimary,
                android.R.color.holo_green_dark,
                android.R.color.holo_orange_dark,
                android.R.color.holo_blue_dark
        );
    }

    /**
     * Set up toolbar
     */
    private void setUpToolbar() {
        Toolbar toolbar = findViewById(R.id.toolbar);
        toolbar.setTitleTextColor(Color.WHITE);
        toolbar.setNavigationIcon(R.drawable.ic_close_white_24dp);
        setSupportActionBar(toolbar);
        getSupportActionBar().setTitle("FGShop Cart");
        getSupportActionBar().setHomeButtonEnabled(true);
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        toolbar.setNavigationOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                finish();
            }
        });
    }

    @Override
    public void carts(List<Cart> carts) {
        adapter = new CartAdapter(this, carts, R.layout.item_cart, presenterLogicCart);
        recycler_cart.setAdapter(adapter);
        presenterLogicCart.total(Common.CURRENT_USER.getId());
        adapter.notifyDataSetChanged();
        swipeRefreshLayout.setRefreshing(false);
    }

    @Override
    public void total(int total) {
        NumberFormat numberFormat = new DecimalFormat("###,###");
        if (total == 0) tvTotal.setText("0 VND");
        else tvTotal.setText(String.valueOf(numberFormat.format(Integer.valueOf(total)) + " VND"));
    }

    @Override
    public void error(String msg) {
        Utils.showSnackBarShort(main_layout, msg);
    }

    @Override
    public void onSwiped(RecyclerView.ViewHolder viewHolder, int direction, int position) {
        if (viewHolder instanceof CartHolder) {
            String name = ((CartAdapter)recycler_cart.getAdapter()).getItem(viewHolder.getAdapterPosition()).getName();
            final Cart deleteItem = ((CartAdapter)recycler_cart.getAdapter()).getItem(viewHolder.getAdapterPosition());
            final int deleteIndex = viewHolder.getAdapterPosition();
            adapter.removeItem(deleteIndex);
            presenterLogicCart.removeIndex(Common.CURRENT_USER.getId(), deleteItem.getId_product());
            //Refresh
            presenterLogicCart.carts(Common.CURRENT_USER.getId());
            //Make SnackBar
            Snackbar snackbar = Snackbar.make(findViewById(R.id.main_layout), name + " removed from cart!", Snackbar.LENGTH_LONG);
            snackbar.setAction("UNDO", new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    adapter.restoreItem(deleteItem, deleteIndex);
                    presenterLogicCart.save(deleteItem);
                    //Refresh
                    presenterLogicCart.carts(Common.CURRENT_USER.getId());
                }
            });
            snackbar.setActionTextColor(Color.YELLOW);
            snackbar.show();
        }
    }

    @Override
    protected void onResume() {
        super.onResume();
        presenterLogicCart.total(Common.CURRENT_USER.getId());
        presenterLogicCart.carts(Common.CURRENT_USER.getId());
    }
}
