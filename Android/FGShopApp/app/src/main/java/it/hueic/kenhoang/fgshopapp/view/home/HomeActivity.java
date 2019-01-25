package it.hueic.kenhoang.fgshopapp.view.home;

import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import androidx.swiperefreshlayout.widget.SwipeRefreshLayout;
import androidx.appcompat.app.AlertDialog;
import androidx.recyclerview.widget.GridLayoutManager;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;
import android.view.View;
import com.google.android.material.navigation.NavigationView;
import androidx.core.view.GravityCompat;
import androidx.drawerlayout.widget.DrawerLayout;
import androidx.appcompat.app.ActionBarDrawerToggle;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;
import android.view.Menu;
import android.view.MenuItem;
import android.view.animation.AnimationUtils;
import android.view.animation.LayoutAnimationController;
import android.widget.TextView;

import com.andremion.counterfab.CounterFab;
import com.squareup.picasso.Picasso;
import com.valdesekamdem.library.mdtoast.MDToast;

import java.util.HashMap;
import java.util.List;

import de.hdodenhof.circleimageview.CircleImageView;
import io.paperdb.Paper;
import it.hueic.kenhoang.fgshopapp.R;
import it.hueic.kenhoang.fgshopapp.adapter.CustomSliderAdapter;
import it.hueic.kenhoang.fgshopapp.adapter.GroupProductTypeAdapter;
import it.hueic.kenhoang.fgshopapp.common.Common;
import it.hueic.kenhoang.fgshopapp.helper.PicassoImageLoadingService;
import it.hueic.kenhoang.fgshopapp.object.Banner;
import it.hueic.kenhoang.fgshopapp.object.GroupProductType;
import it.hueic.kenhoang.fgshopapp.presenter.home.PresenterLogicHome;
import it.hueic.kenhoang.fgshopapp.utils.Utils;
import it.hueic.kenhoang.fgshopapp.view.detail.DetailActivity;
import ss.com.bannerslider.Slider;
import ss.com.bannerslider.event.OnSlideClickListener;
import uk.co.chrisjenx.calligraphy.CalligraphyConfig;
import uk.co.chrisjenx.calligraphy.CalligraphyContextWrapper;

public class HomeActivity extends AppCompatActivity implements
        NavigationView.OnNavigationItemSelectedListener,
        IViewHome
{

    private static final String TAG = HomeActivity.class.getSimpleName();
    //View
    TextView tvFullName, tvTitle;
    CounterFab fab;
    CircleImageView profile_image;
    private RecyclerView recycler_group_product_type;
    private RecyclerView.LayoutManager mLayoutManger;
    private SwipeRefreshLayout swipeRefreshLayout;
    private boolean statusItemList = false;
    NavigationView navigationView;
    Menu nav_menu;
    Menu menu;
    //Presenter
    PresenterLogicHome presenterLogicHome;
    //Slider
    HashMap<String, String> image_list;
    Slider mSlider;

    //Need call this function after you init database firebase
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
        setContentView(R.layout.activity_home);
        //Init Paper
        Paper.init(this);
        //Init View
        initView();
        //Init Presenter
        presenterLogicHome = new PresenterLogicHome(this);
        presenterLogicHome.loadBanners();
        presenterLogicHome.loadGroupProductTypes();
        //Check User != null
        existUser();
        if (Utils.isLogin()) presenterLogicHome.countCart(this, Common.CURRENT_USER.getId());
        //Event
        fab.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Utils.openCart(HomeActivity.this);
            }
        });
        //Load Data
        swipeRefreshLayout.setOnRefreshListener(new SwipeRefreshLayout.OnRefreshListener() {
            @Override
            public void onRefresh() {
                presenterLogicHome.loadGroupProductTypes();
            }
        });
        //Default, load for first time
        swipeRefreshLayout.post(new Runnable() {
            @Override
            public void run() {
                presenterLogicHome.loadGroupProductTypes();
            }
        });

    }

    private void existUser() {
        if (Common.CURRENT_USER != null) {
            if (Common.CURRENT_USER.getAvatar() != null && !Common.CURRENT_USER.getAvatar().equals("null")) {
                Picasso.get()
                        .load(Common.URL + Common.CURRENT_USER.getAvatar())
                        .into(profile_image);
            } else {
                profile_image.setImageResource(R.drawable.image_null);
            }
            tvFullName.setText(Common.CURRENT_USER.getName());
            nav_menu.findItem(R.id.nav_login).setVisible(false);
            nav_menu.findItem(R.id.nav_log_out).setVisible(true);
            Paper.book().write(Common.USERNAME_KEY, Common.CURRENT_USER.getUsername());
            Paper.book().write(Common.PASSWORD_KEY, Common.CURRENT_USER.getPassword());
        } else {
            profile_image.setImageResource(R.drawable.image_null);
            tvFullName.setText(getString(R.string.anonymous));
            nav_menu.findItem(R.id.nav_login).setVisible(true);
            nav_menu.findItem(R.id.nav_log_out).setVisible(false);
        }
    }

    private void initView() {
        Toolbar toolbar = findViewById(R.id.toolbar);
        tvTitle         = findViewById(R.id.tvTitle);
        tvTitle.setText("Menu");
        setSupportActionBar(toolbar);

        fab = findViewById(R.id.fab);

        DrawerLayout drawer = findViewById(R.id.drawer_layout);
        ActionBarDrawerToggle toggle = new ActionBarDrawerToggle(
                this, drawer, toolbar, R.string.navigation_drawer_open, R.string.navigation_drawer_close);
        drawer.addDrawerListener(toggle);
        toggle.syncState();

        navigationView = findViewById(R.id.nav_view);
        navigationView.setNavigationItemSelectedListener(this);
        //FindView Header
        View headerView = navigationView.getHeaderView(0);
        profile_image = headerView.findViewById(R.id.profile_image);
        tvFullName      = headerView.findViewById(R.id.tvFullName);
        nav_menu = navigationView.getMenu();
        //recycler
        recycler_group_product_type    = findViewById(R.id.recycler_group_product_type);
        mLayoutManger   = new LinearLayoutManager(this);
        if (statusItemList) {
            recycler_group_product_type.setHasFixedSize(true);
            recycler_group_product_type.setLayoutManager(mLayoutManger);
        } else {
            recycler_group_product_type.setLayoutManager(new GridLayoutManager(this, 2));
        }
        //Add animation recycler
        LayoutAnimationController controller = AnimationUtils.loadLayoutAnimation(recycler_group_product_type.getContext(),
                R.anim.layout_fall_down);
        recycler_group_product_type.setLayoutAnimation(controller);
        //SwipeRefresh Layout
        swipeRefreshLayout = findViewById(R.id.swipe_layout);
        swipeRefreshLayout.setColorSchemeResources(R.color.colorPrimary,
                android.R.color.holo_green_dark,
                android.R.color.holo_orange_dark,
                android.R.color.holo_blue_dark
        );
        //Slider
        mSlider = findViewById(R.id.slider);
        Slider.init(new PicassoImageLoadingService());
    }

    @Override
    public void onBackPressed() {
        DrawerLayout drawer =  findViewById(R.id.drawer_layout);
        if (drawer.isDrawerOpen(GravityCompat.START)) {
            drawer.closeDrawer(GravityCompat.START);
        } else {
            super.onBackPressed();
        }
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu_detail; this adds items to the action bar if it is present.
        this.menu = menu;
        getMenuInflater().inflate(R.menu.home, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();
        switch (id) {
            case R.id.action_view:
                statusItemList = !statusItemList;
                if (statusItemList) {
                    menu.getItem(0).setIcon(getResources().getDrawable(R.drawable.icon_view_list));
                    recycler_group_product_type.setHasFixedSize(true);
                    recycler_group_product_type.setLayoutManager(mLayoutManger);
                } else {
                    menu.getItem(0).setIcon(getResources().getDrawable(R.drawable.icon_view_grid));
                    recycler_group_product_type.setLayoutManager(new GridLayoutManager(this, 2));
                }
                presenterLogicHome.loadGroupProductTypes();
                break;
            case R.id.action_search:
                Utils.showToastShort(this, "Comming soon", MDToast.TYPE_INFO);
                break;
        }
        //noinspection SimplifiableIfStatement

        return super.onOptionsItemSelected(item);
    }

    @SuppressWarnings("StatementWithEmptyBody")
    @Override
    public boolean onNavigationItemSelected(MenuItem item) {
        // Handle navigation view item clicks here.
        int id = item.getItemId();
        switch (id) {
            case R.id.nav_login:
                Utils.openLogin(this);
                break;
            case R.id.nav_update_name:
                //handle after
                break;
            case R.id.nav_home_address:
                //handle after
                break;
            case R.id.nav_fav:
                Utils.openFavorite(HomeActivity.this);
                break;
            case R.id.nav_cart:
                Utils.openCart(HomeActivity.this);
                break;
            case R.id.nav_orders:
                Utils.openOrder(HomeActivity.this);
                break;
            case R.id.nav_setting:
                //handle after
                break;
            case R.id.nav_change_pass:
                //handle after
                break;
            case R.id.nav_log_out:
                presenterLogicHome.logout(Common.CURRENT_USER.getToken());
                break;
        }
        DrawerLayout drawer = findViewById(R.id.drawer_layout);
        drawer.closeDrawer(GravityCompat.START);
        return true;
    }

    @Override
    public void showBanners(final List<Banner> banners) {
        image_list = new HashMap<>();
        mSlider.setAdapter(new CustomSliderAdapter(banners));
        mSlider.setOnSlideClickListener(new OnSlideClickListener() {
            @Override
            public void onSlideClick(int position) {
                Intent detailIntent = new Intent(HomeActivity.this, DetailActivity.class);
                detailIntent.putExtra("id_product", banners.get(position).getId_product());
                startActivity(detailIntent);
            }
        });
    }

    @Override
    public void showGroupProductTypes(List<GroupProductType> groupProductTypes) {
        GroupProductTypeAdapter adapter = new GroupProductTypeAdapter(this,
                groupProductTypes,
                statusItemList ? R.layout.item_group_product_type_list : R.layout.item_group_product_type_grid);
        //Animation
        recycler_group_product_type.scheduleLayoutAnimation();
        recycler_group_product_type.setAdapter(adapter);
        adapter.notifyDataSetChanged();
        swipeRefreshLayout.setRefreshing(false);
    }

    @Override
    public void showError() {

    }

    @Override
    public void logout(int status) {
        if (status == 200) {
            Common.CURRENT_USER = null;
            existUser();
            Paper.book().destroy();
            Utils.showToastShort(getApplicationContext(), "Logout success", MDToast.TYPE_SUCCESS);
        } else if (status == 400) {
            Utils.showToastShort(getApplicationContext(), "Token not exists", MDToast.TYPE_ERROR);
        } else if (status == 401) {
            Utils.showToastShort(getApplicationContext(), "Unauthorized user", MDToast.TYPE_ERROR);
        }
    }

    @Override
    public void countCart(int count) {
        fab.setCount(count);
    }

    @Override
    protected void onResume() {
        super.onResume();
        if (Utils.isLogin()) presenterLogicHome.countCart(this, Common.CURRENT_USER.getId());
    }

    @Override
    protected void onStop() {
        super.onStop();
    }
}
