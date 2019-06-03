import {JetView} from "webix-jet";

export default class Auth extends JetView {
    config() {
        return {
            type: "clean",
            cols: [
                {},
                {
                    type: "clean",
                    rows: [
                        { $subview: true },
                        {}
                    ]
                },
                {}
            ]
        }
    }
}
