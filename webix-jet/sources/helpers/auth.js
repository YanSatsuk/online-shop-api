import { getCsrfToken } from './csrfToken';

export default function Auth(app) {
    let _isAuth = false;

    const isAuth = () => {
        return _isAuth;
    }

    const logout = () => {
        _isAuth = false;
    }

    const login = () => {
        _isAuth = true;
    }

    const post = (url, data) => {
        //data['_token'] = getCsrfToken();
        return webix.ajax().post(url, data)
    }

    const service = {
        signup(values) {
            return post("/api/auth/signup", values);
        },
        signin(values) {
            return post('/api/auth/login', values);
        },
        isAuth,
        login,
        logout
    }

    app.setService("auth", service);
}
