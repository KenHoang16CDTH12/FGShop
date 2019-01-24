package it.hueic.kenhoang.fgshopapp.view.orderdetail;

import android.content.Context;
import android.graphics.Color;
import androidx.appcompat.app.AppCompatActivity;
import android.os.Bundle;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;
import androidx.appcompat.widget.Toolbar;
import android.view.View;

import java.text.DecimalFormat;
import java.text.NumberFormat;
import java.util.List;

import it.hueic.kenhoang.fgshopapp.R;
import it.hueic.kenhoang.fgshopapp.adapter.OrderDetailAdapter;
import it.hueic.kenhoang.fgshopapp.common.Common;
import it.hueic.kenhoang.fgshopapp.object.OrderDetail;
import it.hueic.kenhoang.fgshopapp.presenter.orderdetail.PresenterLogicOrderDetail;
import uk.co.chrisjenx.calligraphy.CalligraphyConfig;
import uk.co.chrisjenx.calligraphy.CalligraphyContextWrapper;

public class OrderDetailActivity extends AppCompatActivity implements
        IViewOrderDetail {
    private static final String TAG = OrderDetailActivity.class.getSimpleName();
    RecyclerView recycler_order_detail;
    OrderDetailAdapter adapter;
    RecyclerView.LayoutManager mLayoutManager;
    PresenterLogicOrderDetail presenterLogicOrderDetail;
    int id_order = 0;
    //Need call this function after you init database
    @Override
    protected void attachBaseContext(Context newBase) {
        super.attachBaseContext(CalligraphyContextWrapper.wrap(newBase));
    }

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        CalligraphyConfig.initDefault(new CalligraphyConfig.Builder()
                .setDefaultFontPath("fonts/font_main.otf")
                .setFontAttrId(R.attr.fontPath)
                .build());
        setContentView(R.layout.activity_order_detail);
        if (getIntent() != null) {
            id_order = getIntent().getIntExtra("id_order", 0);
        }
        //InitView
        initView();
        //InitPresenter
        presenterLogicOrderDetail = new PresenterLogicOrderDetail(this);
        presenterLogicOrderDetail.orderDetails(Common.CURRENT_USER.getToken(), id_order);
    }

    private void initView() {
        setUpToolbar();
        recycler_order_detail = findViewById(R.id.recycler_order_detail);
        recycler_order_detail.setHasFixedSize(true);
        mLayoutManager = new LinearLayoutManager(this);
        recycler_order_detail.setLayoutManager(mLayoutManager);
    }

    /**
     * Set up toolbar
     */
    private void setUpToolbar() {
        Toolbar toolbar = findViewById(R.id.toolbar);
        toolbar.setTitleTextColor(Color.WHITE);
        toolbar.setNavigationIcon(R.drawable.ic_close_white_24dp);
        setSupportActionBar(toolbar);
        getSupportActionBar().setTitle("FGShop Order Detail");
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
    public void orderDetails(List<OrderDetail> orderDetails, int total) {
        adapter = new OrderDetailAdapter(this, orderDetails, R.layout.item_order_detail);
        recycler_order_detail.setAdapter(adapter);
        adapter.notifyDataSetChanged();
        final NumberFormat numberFormat = new DecimalFormat("###,###");
        getSupportActionBar().setTitle(String.valueOf(numberFormat.format(total) + " VND"));
    }

    @Override
    protected void onResume() {
        super.onResume();

        presenterLogicOrderDetail.orderDetails(Common.CURRENT_USER.getToken(), id_order);
    }
}
