import { JetView } from "webix-jet";
import tree from "./tree";
// import table from "./table";

export default class Main extends JetView {
    config() {
        return {
            cols: [
                tree,
                { $subview: true }
            ]
        }
    }
}
