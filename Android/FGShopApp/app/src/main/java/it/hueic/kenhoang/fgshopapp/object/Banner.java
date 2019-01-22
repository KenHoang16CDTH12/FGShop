package it.hueic.kenhoang.fgshopapp.object;

public class Banner {
    private int id;
    private int id_product;
    private String name_product;
    private String image;

    public Banner() {
    }

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

    public String getName_product() {
        return name_product;
    }

    public void setName_product(String name_product) {
        this.name_product = name_product;
    }

    public String getImage() {
        return image;
    }

    public void setImage(String image) {
        this.image = image;
    }
}
