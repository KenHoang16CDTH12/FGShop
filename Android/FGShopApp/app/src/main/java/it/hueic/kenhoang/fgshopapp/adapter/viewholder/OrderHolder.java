package it.hueic.kenhoang.fgshopapp.adapter.viewholder;

import androidx.recyclerview.widget.RecyclerView;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

import it.hueic.kenhoang.fgshopapp.R;

public class OrderHolder extends RecyclerView.ViewHolder {

    public TextView txtOrderId, txtOrderStatus, txtOrderPhone, txtOrderAddress;
    public Button btnRemove, btnDetail;

    public OrderHolder(View itemView) {
        super(itemView);
        txtOrderId = itemView.findViewById(R.id.order_id);
        txtOrderStatus = itemView.findViewById(R.id.order_status);
        txtOrderPhone = itemView.findViewById(R.id.order_phone);
        txtOrderAddress = itemView.findViewById(R.id.order_address);

        btnDetail = itemView.findViewById(R.id.btnDetail);
        btnRemove = itemView.findViewById(R.id.btnRemove);
    }
}
