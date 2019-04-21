package it.hueic.kenhoang.fgshopapp.view.detail;

import android.content.Context;
import android.graphics.Color;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

import com.cepheuen.elegantnumberbutton.view.ElegantNumberButton;
import com.google.android.material.tabs.TabLayout;
import com.stepstone.apprating.AppRatingDialog;
import com.stepstone.apprating.listener.RatingDialogListener;
import com.valdesekamdem.library.mdtoast.MDToast;

import java.text.DecimalFormat;
import java.text.NumberFormat;
import java.util.Arrays;
import java.util.Calendar;

import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;
import androidx.viewpager.widget.ViewPager;
import it.hueic.kenhoang.fgshopapp.R;
import it.hueic.kenhoang.fgshopapp.adapter.ViewPagerAdapterDetail;
import it.hueic.kenhoang.fgshopapp.common.Common;
import it.hueic.kenhoang.fgshopapp.helper.DatabaseHelper;
import it.hueic.kenhoang.fgshopapp.object.OrderDetail;
import it.hueic.kenhoang.fgshopapp.object.Product;
import it.hueic.kenhoang.fgshopapp.presenter.detail.PresenterLogicDetail;
import it.hueic.kenhoang.fgshopapp.presenter.detail.commom.PresenterLogicDetailCommom;
import it.hueic.kenhoang.fgshopapp.utils.Utils;
import it.hueic.kenhoang.fgshopapp.view.detail.commom.IViewDetailCommom;
import uk.co.chrisjenx.calligraphy.CalligraphyConfig;
import uk.co.chrisjenx.calligraphy.CalligraphyContextWrapper;

public class DetailActivity extends AppCompatActivity implements
        IViewDetail,
        IViewDetailCommom,
        RatingDialogListener, ElegantNumberButton.OnValueChangeListener {
    private static final String TAG = DetailActivity.class.getSimpleName();
    Toolbar toolbar;
    TabLayout tabLayout;
    ViewPager viewPager;
    TextView price;
    Button btnCart;
    ElegantNumberButton buttonNumber;
    PresenterLogicDetailCommom presenterLogicDetailCommom;
    PresenterLogicDetail presenterLogicDetail;
    Product current_product;
    int id_product;
    TextView tvCount;
    boolean onPause = false;
    ViewPagerAdapterDetail viewPagerAdapterDetail;
    //Need call this function after you init database firebase
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
        setContentView(R.layout.activity_detail);//Notes : add this code before setContentView
        if (getIntent() != null) {
            id_product = getIntent().getIntExtra("id_product", 0);
        }
        //InitView
        initView();
        //Init Presenter
        presenterLogicDetail = new PresenterLogicDetail(this);
        presenterLogicDetailCommom = new PresenterLogicDetailCommom(this);
        presenterLogicDetailCommom.fillData(id_product);
        //Init event
        buttonNumber.setOnValueChangeListener(this);
        btnCart.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if (Utils.isLogin()) {
                    OrderDetail orderDetail = new OrderDetail();
                    orderDetail.setId_user(Common.CURRENT_USER.getId());
                    orderDetail.setId_product(id_product);
                    orderDetail.setQuantity(Integer.parseInt(buttonNumber.getNumber()));
                    new DatabaseHelper(DetailActivity.this).saveCart(orderDetail);
                    Utils.showToastShort(getApplicationContext(), "Add to cart success!", MDToast.TYPE_SUCCESS);
                } else {
                    Utils.openLogin(DetailActivity.this);
                }
            }
        });
    }

    private void initView() {
        setUpToolbar();//Setup toolbar
        tabLayout = findViewById(R.id.tab);
        viewPager = findViewById(R.id.viewpager);
        price = findViewById(R.id.price);
        buttonNumber = findViewById(R.id.number_button);
        btnCart = findViewById(R.id.btnCart);

        viewPagerAdapterDetail = new ViewPagerAdapterDetail(getSupportFragmentManager());
        viewPager.setAdapter(viewPagerAdapterDetail);
        viewPagerAdapterDetail.notifyDataSetChanged();

        tabLayout.setupWithViewPager(viewPager);
    }

    /**
     * Set up toolbar
     */
    private void setUpToolbar() {
        toolbar = findViewById(R.id.toolbar);
        toolbar.setTitleTextColor(Color.WHITE);
        toolbar.setNavigationIcon(R.drawable.ic_close_white_24dp);
        setSupportActionBar(toolbar);
        getSupportActionBar().setTitle("FGShop");
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
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.menu_detail, menu);
        //Get a reference to your item by id
        MenuItem item = menu.findItem(R.id.action_cart);
        View cart_custom = item.getActionView();
        tvCount = cart_custom.findViewById(R.id.tvCount);
        cart_custom.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Utils.openCart(DetailActivity.this);
            }
        });
        if (Utils.isLogin()) presenterLogicDetail.countCart(this, Common.CURRENT_USER.getId());
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();
        switch (id) {
            case R.id.action_rating:
                if (Utils.isLogin()) {
                    new AppRatingDialog.Builder()
                            .setPositiveButtonText("Submit")
                            .setNegativeButtonText("Cancel")
                            .setNeutralButtonText("Later")
                            .setNoteDescriptions(Arrays.asList("Very Bad", "Not good", "Quite ok", "Very Good", "Excellent !!!"))
                            .setDefaultRating(2)
                            .setTitle("Rate this product")
                            .setDescription("Please select some stars and give your feedback")
                            .setStarColor(R.color.starColor)
                            .setNoteDescriptionTextColor(R.color.noteDescriptionTextColor)
                            .setTitleTextColor(R.color.titleTextColor)
                            .setDescriptionTextColor(R.color.descriptionTextColor)
                            .setHint("Please write your comment here ...")
                            .setHintTextColor(R.color.hintTextColor)
                            .setCommentTextColor(R.color.commentTextColor)
                            .setCommentBackgroundColor(R.color.colorGray)
                            .setWindowAnimation(R.style.MyDialogFadeAnimation)
                            .create(DetailActivity.this)
                            .show();
                } else {
                    Utils.openLogin(this);
                }
                break;
            case R.id.action_search:
                //handle after
                break;
        }
        //noinspection SimplifiableIfStatement
        return super.onOptionsItemSelected(item);
    }

    @Override
    public void onPositiveButtonClicked(int stars, String comment) {
        presenterLogicDetail.store(Common.CURRENT_USER.getToken(), id_product, Common.CURRENT_USER.getId(), comment, stars, String.valueOf(Calendar.getInstance().getTimeInMillis()));
        presenterLogicDetailCommom.fillData(id_product);
        viewPagerAdapterDetail.notifyDataSetChanged();
    }

    @Override
    public void onNegativeButtonClicked() {

    }

    @Override
    public void onNeutralButtonClicked() {

    }

    @Override
    public void rated(int status) {
        if (status == 401) Utils.showToastShort(this, "Unauthorized!", MDToast.TYPE_ERROR);
        if (status == 200) {
            Utils.showToastShort(this, "Thank you rate!", MDToast.TYPE_SUCCESS);
            presenterLogicDetailCommom.fillData(id_product);
        }
    }

    @Override
    public void countCart(int count) {
        if (count <= 0) tvCount.setVisibility(View.GONE);
        else tvCount.setText(String.valueOf(count));
    }

    @Override
    public void fillData(Product product) {
        current_product = product;
        NumberFormat numberFormat = new DecimalFormat("###,###");
        price.setText(String.valueOf(numberFormat.format(Integer.valueOf(product.getPrice())) + " VND"));
    }

    @Override
    public void showError(String message) {

    }

    @Override
    public void onValueChange(ElegantNumberButton view, int oldValue, int newValue) {
        if (current_product != null) {
            int current_price = Integer.parseInt(current_product.getPrice()) * newValue;
            NumberFormat numberFormat = new DecimalFormat("###,###");
            price.setText(String.valueOf(numberFormat.format(current_price) + " VND"));
        }
    }

    @Override
    protected void onResume() {
        super.onResume();
        viewPagerAdapterDetail.notifyDataSetChanged();
        if (onPause)
            if (Utils.isLogin())
                presenterLogicDetail.countCart(this, Common.CURRENT_USER.getId());
    }

    @Override
    protected void onPause() {
        super.onPause();
        onPause = true;
    }
}
