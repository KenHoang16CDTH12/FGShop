package it.hueic.kenhoang.fgshopapp.object;

public class Product {
    private int id;
    private String name_product;
    private String price;
    private String isbn;
    private String infor;
    private String desc;
    private String status;
    private int quanity;
    private User add_by;
    private Brand brand;
    private String image;
    private float rate;
    private int num_people_rates;
    private int num_likes;

    public Product() {
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getName_product() {
        return name_product;
    }

    public void setName_product(String name_product) {
        this.name_product = name_product;
    }

    public String getPrice() {
        return price;
    }

    public void setPrice(String price) {
        this.price = price;
    }

    public String getIsbn() {
        return isbn;
    }

    public void setIsbn(String isbn) {
        this.isbn = isbn;
    }

    public String getInfor() {
        return infor;
    }

    public void setInfor(String infor) {
        this.infor = infor;
    }

    public String getDesc() {
        return desc;
    }

    public void setDesc(String desc) {
        this.desc = desc;
    }

    public String getStatus() {
        return status;
    }

    public void setStatus(String status) {
        this.status = status;
    }

    public int getQuanity() {
        return quanity;
    }

    public void setQuanity(int quanity) {
        this.quanity = quanity;
    }

    public User getAdd_by() {
        return add_by;
    }

    public void setAdd_by(User add_by) {
        this.add_by = add_by;
    }

    public Brand getBrand() {
        return brand;
    }

    public void setBrand(Brand brand) {
        this.brand = brand;
    }

    public String getImage() {
        return image;
    }

    public void setImage(String image) {
        this.image = image;
    }

    public float getRate() {
        return rate;
    }

    public void setRate(float rate) {
        this.rate = rate;
    }

    public int getNum_people_rates() {
        return num_people_rates;
    }

    public void setNum_people_rates(int num_people_rates) {
        this.num_people_rates = num_people_rates;
    }

    public int getNum_likes() {
        return num_likes;
    }

    public void setNum_likes(int num_likes) {
        this.num_likes = num_likes;
    }
}
