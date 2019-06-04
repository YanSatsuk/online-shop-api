import {JetView} from "webix-jet";

export default class Tree extends JetView {
    config() {
        return {
            view: "tree",
            width: 350,
            data: [
                {
                    id: "root", value: "Phones", data: [
                        {
                            id: "1", value: "Nokia"
                        },
                        {
                            id: "2", value: "Samsung"
                        }
                    ]
                }
            ]
        }
    }
}
