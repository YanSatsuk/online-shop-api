import {JetView} from "webix-jet";

export default class Table extends JetView {
    config() {
        return {
            view: "datatable",
            type: {
                amountCounter: function (obj) {
                    return `<button type="button" class="webix_inp_counter_prev" tabindex="-1" aria-label="Decrease value">-</button>
                            <input type="text" class="webix_inp_counter_value" aria-live="assertive" value=${obj.amount}>
                            <button type="button" class="webix_inp_counter_next" tabindex="-1" aria-label="Increase value">+</button>`
                }
            },
            columns: [
                {id: "image", header: "Image", width: 150},
                {id: "name", header: "Name", minWidth: 400, fillspace: true},
                {id: "price", header: "Price", width: 100},
                {id: "rating", header: "Rating", width: 100},
                {id: "amount", header: "Amount", width: 120, template: "{common.amountCounter()}"},
                {
                    id: "buy",
                    header: "Buy",
                    width: 60,
                    template: "<img src='/svg/cart-outline.svg' class='cart_padding'/>",
                    type: "clean"
                }
            ],
            on: {
                "onItemDblClick": function (id, e, trg) {
                    console.log(id);
                    console.log(trg);
                    webix.message("Click on row: " + id.row + ", column: " + id.column);
                }
            },
            onClick: {
                "webix_inp_counter_prev": function (id, ev) {
                    var item = this.getItem(ev.row);
                    if (item.amount > 0) {
                        item.amount--;
                        this.updateItem(ev.row, item);
                    }
                },
                "webix_inp_counter_next": function (id, ev) {
                    var item = this.getItem(ev.row);
                    item.amount++;
                    this.updateItem(ev.row, item);
                },
                "cart_padding": function () {
                    console.log("img click");
                }
            },
            data: [
                {id: 1, name: "The Shawshank Redemption", price: 1994, rating: 678790, amount: 3},
                {id: 2, name: "The Godfather", price: 1972, rating: 511495, amount: 2}
            ]
        }
    }
}
