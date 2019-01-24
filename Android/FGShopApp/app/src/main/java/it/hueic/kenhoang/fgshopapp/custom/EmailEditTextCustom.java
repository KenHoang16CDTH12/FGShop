package it.hueic.kenhoang.fgshopapp.custom;

import android.annotation.SuppressLint;
import android.annotation.TargetApi;
import android.content.Context;
import android.graphics.drawable.Drawable;
import android.os.Build;
import androidx.core.content.ContextCompat;
import android.text.InputType;
import android.util.AttributeSet;
import android.view.MotionEvent;
import android.widget.EditText;

import it.hueic.kenhoang.fgshopapp.R;

/**
 * Created by kenhoang on 03/03/2018.
 */

@SuppressLint("AppCompatCustomView")
public class EmailEditTextCustom extends EditText {
    Drawable crossX, noneCrossX;
    Drawable drawable;
    boolean isVisible = false;

    public EmailEditTextCustom(Context context) {
        super(context);
        initView();
    }

    public EmailEditTextCustom(Context context, AttributeSet attrs) {
        super(context, attrs);
        initView();
    }

    public EmailEditTextCustom(Context context, AttributeSet attrs, int defStyleAttr) {
        super(context, attrs, defStyleAttr);
        initView();
    }

    @TargetApi(Build.VERSION_CODES.LOLLIPOP)
    public EmailEditTextCustom(Context context, AttributeSet attrs, int defStyleAttr, int defStyleRes) {
        super(context, attrs, defStyleAttr, defStyleRes);
        initView();
    }

    private void initView() {
        crossX = ContextCompat.getDrawable(getContext(), R.drawable.ic_clear_black_24dp).mutate();
        noneCrossX = ContextCompat.getDrawable(getContext(), android.R.drawable.screen_background_light_transparent).mutate();
        setUpView();
    }

    private void setUpView() {
        setRawInputType(InputType.TYPE_CLASS_TEXT);
        Drawable[] drawables = getCompoundDrawables();
        drawable = isVisible ? crossX : noneCrossX;
        setCompoundDrawablesWithIntrinsicBounds(drawables[0], drawables[1], drawable, drawables[3]);
    }

    @Override
    protected void onTextChanged(CharSequence text, int start, int lengthBefore, int lengthAfter) {
        super.onTextChanged(text, start, lengthBefore, lengthAfter);
        if (lengthAfter == 0 && start == 0) {
            isVisible = false;
            setUpView();
        } else {
            isVisible = true;
            setUpView();
        }
    }

    @Override
    public boolean onTouchEvent(MotionEvent event) {
        if (MotionEvent.ACTION_DOWN == event.getAction() && event.getX() >= (getRight() - drawable.getBounds().width()))
            setText("");
        return super.onTouchEvent(event);
    }
}
