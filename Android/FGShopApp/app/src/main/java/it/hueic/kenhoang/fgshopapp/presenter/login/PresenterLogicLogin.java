package it.hueic.kenhoang.fgshopapp.presenter.login;

import it.hueic.kenhoang.fgshopapp.model.ModelLogin;
import it.hueic.kenhoang.fgshopapp.object.User;
import it.hueic.kenhoang.fgshopapp.view.login.IViewLogin;


public class PresenterLogicLogin implements IPresenterLogin{
    IViewLogin view;
    ModelLogin model;

    public PresenterLogicLogin(IViewLogin view) {
        this.view = view;
        model = new ModelLogin();
    }

    @Override
    public void validateLogin(String email, String pass) {
        User user = model.validateLogin(email, pass);
        if (user == null) view.loginFailed("Invalid login!");
        else view.loginSuccess(user);
    }

    @Override
    public void registerUser(User user) {
        User userOriginal = model.register(user);
        if (userOriginal == null) view.registerFailed("User is exists");
        else view.registerSuccess(userOriginal);
    }

    @Override
    public int isExists(String username) {
        return model.isExists(username);
    }
}
