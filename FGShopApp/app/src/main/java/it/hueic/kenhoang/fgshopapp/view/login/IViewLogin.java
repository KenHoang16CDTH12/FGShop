package it.hueic.kenhoang.fgshopapp.view.login;

import it.hueic.kenhoang.fgshopapp.object.User;

public interface IViewLogin {
    void loginSuccess(User user);
    void loginFailed(String msg);
    void registerFailed(String message);
    void registerSuccess(User user);
}
