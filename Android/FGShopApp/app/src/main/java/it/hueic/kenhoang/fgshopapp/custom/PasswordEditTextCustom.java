package it.hueic.kenhoang.fgshopapp.custom;

import android.annotation.SuppressLint;
import android.annotation.TargetApi;
import android.content.Context;
import android.content.res.TypedArray;
import android.graphics.drawable.Drawable;
import android.os.Build;
import android.text.InputType;
import android.util.AttributeSet;
import android.view.MotionEvent;
import android.view.View;
import android.widget.EditText;

import com.google.android.material.textfield.TextInputLayout;

import java.util.regex.Matcher;
import java.util.regex.Pattern;

import androidx.core.content.ContextCompat;
import it.hueic.kenhoang.fgshopapp.R;

/**
 * Created by kenhoang on 03/03/2018.
 */

@SuppressLint("AppCompatCustomView")
public class PasswordEditTextCustom extends EditText{
    private static final String TAG = PasswordEditTextCustom.class.getSimpleName();
    Drawable eye, eyeStrike;
    Drawable drawable;
    boolean isVisible = false;
    boolean useStrike = false;
    boolean useValidator = false;
    private static final String MATCHER_PATTERN = "((?=.*\\d)(?=.*[A-Z])(?=.*[a-z]).{6,20})"; //(?=.*[@#$%])
    Pattern pattern;
    Matcher matcher;
    private static final int ALPHA = (int) (255 * .70f);

    public PasswordEditTextCustom(Context context) {
        super(context);
        initView(null);
    }

    public PasswordEditTextCustom(Context context, AttributeSet attrs) {
        super(context, attrs);
        initView(attrs);
    }

    public PasswordEditTextCustom(Context context, AttributeSet attrs, int defStyleAttr) {
        super(context, attrs, defStyleAttr);
        initView(attrs);
    }

    @TargetApi(Build.VERSION_CODES.LOLLIPOP)
    public PasswordEditTextCustom(Context context, AttributeSet attrs, int defStyleAttr, int defStyleRes) {
        super(context, attrs, defStyleAttr, defStyleRes);
        initView(attrs);
    }

    private void initView(AttributeSet attrs) {
        this.pattern = Pattern.compile(MATCHER_PATTERN);
        if (attrs != null) {
            TypedArray typedArray = getContext().getTheme().obtainStyledAttributes(attrs, R.styleable.PasswordEditTextCustom, 0, 0);
            this.useStrike = typedArray.getBoolean(R.styleable.PasswordEditTextCustom_useStrike, false);
            this.useValidator = typedArray.getBoolean(R.styleable.PasswordEditTextCustom_useValidate, false);
        }
        eye = ContextCompat.getDrawable(getContext(), R.drawable.ic_visibility_black_24dp).mutate();
        eyeStrike = ContextCompat.getDrawable(getContext(), R.drawable.ic_visibility_off_black_24dp).mutate();
        if (this.useValidator) {
            setOnFocusChangeListener(new OnFocusChangeListener() {
                @Override
                public void onFocusChange(View v, boolean hasFocus) {
                    if (!hasFocus) {
                        String data = getText().toString();
                        TextInputLayout textInputLayout = (TextInputLayout) findViewById(v.getId()).getParent().getParent();
                        matcher = pattern.matcher(data);
                        if (matcher.matches()) {
                            textInputLayout.setErrorEnabled(false);
                            textInputLayout.setError("");
                        } else {
                            textInputLayout.setErrorEnabled(true);
                            textInputLayout.setError("Passwords include 6 characters and a capital letter.");
                        }

                    }
                }
            });
        }
        setupEye();
    }

    private void setupEye() {
        setInputType(InputType.TYPE_CLASS_TEXT | (isVisible ? InputType.TYPE_TEXT_VARIATION_VISIBLE_PASSWORD : InputType.TYPE_TEXT_VARIATION_PASSWORD));
        Drawable[] drawables = getCompoundDrawables();
        drawable = (useStrike && !isVisible ? eyeStrike : eye);
        drawable.setAlpha(ALPHA);
        setCompoundDrawablesWithIntrinsicBounds(drawables[0], drawables[1], drawable , drawables[3]);
    }

    @Override
    public boolean onTouchEvent(MotionEvent event) {
        if (event.getAction() == MotionEvent.ACTION_UP && event.getX() >= (getRight() - drawable.getBounds().width())) {
            isVisible = !isVisible;
            setupEye();
            invalidate();
        }
        return super.onTouchEvent(event);
    }
}
