package it.hueic.kenhoang.fgshopapp.object;

public class Rate {
    private int id;
    private int id_product;
    private User user;
    private float stars;
    private String content;
    private String time_rate;

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public int getId_product() {
        return id_product;
    }

    public void setId_product(int id_product) {
        this.id_product = id_product;
    }

    public User getUser() {
        return user;
    }

    public void setUser(User user) {
        this.user = user;
    }

    public float getStars() {
        return stars;
    }

    public void setStars(float stars) {
        this.stars = stars;
    }

    public String getContent() {
        return content;
    }

    public void setContent(String content) {
        this.content = content;
    }

    public String getTime_rate() {
        return time_rate;
    }

    public void setTime_rate(String time_rate) {
        this.time_rate = time_rate;
    }
}
