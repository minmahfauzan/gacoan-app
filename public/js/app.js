function ze(e, t) {
    return function () {
        return e.apply(t, arguments);
    };
}
const { toString: ht } = Object.prototype,
    { getPrototypeOf: we } = Object,
    { iterator: re, toStringTag: ve } = Symbol,
    se = ((e) => (t) => {
        const n = ht.call(t);
        return e[n] || (e[n] = n.slice(8, -1).toLowerCase());
    })(Object.create(null)),
    L = (e) => ((e = e.toLowerCase()), (t) => se(t) === e),
    oe = (e) => (t) => typeof t === e,
    { isArray: M } = Array,
    H = oe("undefined");
function J(e) {
    return (
        e !== null &&
        !H(e) &&
        e.constructor !== null &&
        !H(e.constructor) &&
        C(e.constructor.isBuffer) &&
        e.constructor.isBuffer(e)
    );
}
const Je = L("ArrayBuffer");
function mt(e) {
    let t;
    return (
        typeof ArrayBuffer < "u" && ArrayBuffer.isView
            ? (t = ArrayBuffer.isView(e))
            : (t = e && e.buffer && Je(e.buffer)),
        t
    );
}
const yt = oe("string"),
    C = oe("function"),
    Ve = oe("number"),
    V = (e) => e !== null && typeof e == "object",
    bt = (e) => e === !0 || e === !1,
    Y = (e) => {
        if (se(e) !== "object") return !1;
        const t = we(e);
        return (
            (t === null ||
                t === Object.prototype ||
                Object.getPrototypeOf(t) === null) &&
            !(ve in e) &&
            !(re in e)
        );
    },
    wt = (e) => {
        if (!V(e) || J(e)) return !1;
        try {
            return (
                Object.keys(e).length === 0 &&
                Object.getPrototypeOf(e) === Object.prototype
            );
        } catch {
            return !1;
        }
    },
    Et = L("Date"),
    gt = L("File"),
    St = L("Blob"),
    Rt = L("FileList"),
    Ot = (e) => V(e) && C(e.pipe),
    Tt = (e) => {
        let t;
        return (
            e &&
            ((typeof FormData == "function" && e instanceof FormData) ||
                (C(e.append) &&
                    ((t = se(e)) === "formdata" ||
                        (t === "object" &&
                            C(e.toString) &&
                            e.toString() === "[object FormData]"))))
        );
    },
    At = L("URLSearchParams"),
    [xt, Ct, Nt, Lt] = ["ReadableStream", "Request", "Response", "Headers"].map(
        L
    ),
    Pt = (e) =>
        e.trim ? e.trim() : e.replace(/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g, "");
function W(e, t, { allOwnKeys: n = !1 } = {}) {
    if (e === null || typeof e > "u") return;
    let r, s;
    if ((typeof e != "object" && (e = [e]), M(e)))
        for (r = 0, s = e.length; r < s; r++) t.call(null, e[r], r, e);
    else {
        if (J(e)) return;
        const i = n ? Object.getOwnPropertyNames(e) : Object.keys(e),
            o = i.length;
        let c;
        for (r = 0; r < o; r++) (c = i[r]), t.call(null, e[c], c, e);
    }
}
function We(e, t) {
    if (J(e)) return null;
    t = t.toLowerCase();
    const n = Object.keys(e);
    let r = n.length,
        s;
    for (; r-- > 0; ) if (((s = n[r]), t === s.toLowerCase())) return s;
    return null;
}
const D =
        typeof globalThis < "u"
            ? globalThis
            : typeof self < "u"
            ? self
            : typeof window < "u"
            ? window
            : global,
    Ke = (e) => !H(e) && e !== D;
function pe() {
    const { caseless: e, skipUndefined: t } = (Ke(this) && this) || {},
        n = {},
        r = (s, i) => {
            const o = (e && We(n, i)) || i;
            Y(n[o]) && Y(s)
                ? (n[o] = pe(n[o], s))
                : Y(s)
                ? (n[o] = pe({}, s))
                : M(s)
                ? (n[o] = s.slice())
                : (!t || !H(s)) && (n[o] = s);
        };
    for (let s = 0, i = arguments.length; s < i; s++)
        arguments[s] && W(arguments[s], r);
    return n;
}
const _t = (e, t, n, { allOwnKeys: r } = {}) => (
        W(
            t,
            (s, i) => {
                n && C(s) ? (e[i] = ze(s, n)) : (e[i] = s);
            },
            { allOwnKeys: r }
        ),
        e
    ),
    Ft = (e) => (e.charCodeAt(0) === 65279 && (e = e.slice(1)), e),
    Bt = (e, t, n, r) => {
        (e.prototype = Object.create(t.prototype, r)),
            (e.prototype.constructor = e),
            Object.defineProperty(e, "super", { value: t.prototype }),
            n && Object.assign(e.prototype, n);
    },
    kt = (e, t, n, r) => {
        let s, i, o;
        const c = {};
        if (((t = t || {}), e == null)) return t;
        do {
            for (s = Object.getOwnPropertyNames(e), i = s.length; i-- > 0; )
                (o = s[i]),
                    (!r || r(o, e, t)) && !c[o] && ((t[o] = e[o]), (c[o] = !0));
            e = n !== !1 && we(e);
        } while (e && (!n || n(e, t)) && e !== Object.prototype);
        return t;
    },
    Ut = (e, t, n) => {
        (e = String(e)),
            (n === void 0 || n > e.length) && (n = e.length),
            (n -= t.length);
        const r = e.indexOf(t, n);
        return r !== -1 && r === n;
    },
    Dt = (e) => {
        if (!e) return null;
        if (M(e)) return e;
        let t = e.length;
        if (!Ve(t)) return null;
        const n = new Array(t);
        for (; t-- > 0; ) n[t] = e[t];
        return n;
    },
    qt = (
        (e) => (t) =>
            e && t instanceof e
    )(typeof Uint8Array < "u" && we(Uint8Array)),
    It = (e, t) => {
        const r = (e && e[re]).call(e);
        let s;
        for (; (s = r.next()) && !s.done; ) {
            const i = s.value;
            t.call(e, i[0], i[1]);
        }
    },
    jt = (e, t) => {
        let n;
        const r = [];
        for (; (n = e.exec(t)) !== null; ) r.push(n);
        return r;
    },
    Ht = L("HTMLFormElement"),
    Mt = (e) =>
        e.toLowerCase().replace(/[-_\s]([a-z\d])(\w*)/g, function (n, r, s) {
            return r.toUpperCase() + s;
        }),
    Ce = (
        ({ hasOwnProperty: e }) =>
        (t, n) =>
            e.call(t, n)
    )(Object.prototype),
    $t = L("RegExp"),
    Xe = (e, t) => {
        const n = Object.getOwnPropertyDescriptors(e),
            r = {};
        W(n, (s, i) => {
            let o;
            (o = t(s, i, e)) !== !1 && (r[i] = o || s);
        }),
            Object.defineProperties(e, r);
    },
    zt = (e) => {
        Xe(e, (t, n) => {
            if (C(e) && ["arguments", "caller", "callee"].indexOf(n) !== -1)
                return !1;
            const r = e[n];
            if (C(r)) {
                if (((t.enumerable = !1), "writable" in t)) {
                    t.writable = !1;
                    return;
                }
                t.set ||
                    (t.set = () => {
                        throw Error(
                            "Can not rewrite read-only method '" + n + "'"
                        );
                    });
            }
        });
    },
    vt = (e, t) => {
        const n = {},
            r = (s) => {
                s.forEach((i) => {
                    n[i] = !0;
                });
            };
        return M(e) ? r(e) : r(String(e).split(t)), n;
    },
    Jt = () => {},
    Vt = (e, t) => (e != null && Number.isFinite((e = +e)) ? e : t);
function Wt(e) {
    return !!(e && C(e.append) && e[ve] === "FormData" && e[re]);
}
const Kt = (e) => {
        const t = new Array(10),
            n = (r, s) => {
                if (V(r)) {
                    if (t.indexOf(r) >= 0) return;
                    if (J(r)) return r;
                    if (!("toJSON" in r)) {
                        t[s] = r;
                        const i = M(r) ? [] : {};
                        return (
                            W(r, (o, c) => {
                                const p = n(o, s + 1);
                                !H(p) && (i[c] = p);
                            }),
                            (t[s] = void 0),
                            i
                        );
                    }
                }
                return r;
            };
        return n(e, 0);
    },
    Xt = L("AsyncFunction"),
    Gt = (e) => e && (V(e) || C(e)) && C(e.then) && C(e.catch),
    Ge = ((e, t) =>
        e
            ? setImmediate
            : t
            ? ((n, r) => (
                  D.addEventListener(
                      "message",
                      ({ source: s, data: i }) => {
                          s === D && i === n && r.length && r.shift()();
                      },
                      !1
                  ),
                  (s) => {
                      r.push(s), D.postMessage(n, "*");
                  }
              ))(`axios@${Math.random()}`, [])
            : (n) => setTimeout(n))(
        typeof setImmediate == "function",
        C(D.postMessage)
    ),
    Qt =
        typeof queueMicrotask < "u"
            ? queueMicrotask.bind(D)
            : (typeof process < "u" && process.nextTick) || Ge,
    Zt = (e) => e != null && C(e[re]),
    a = {
        isArray: M,
        isArrayBuffer: Je,
        isBuffer: J,
        isFormData: Tt,
        isArrayBufferView: mt,
        isString: yt,
        isNumber: Ve,
        isBoolean: bt,
        isObject: V,
        isPlainObject: Y,
        isEmptyObject: wt,
        isReadableStream: xt,
        isRequest: Ct,
        isResponse: Nt,
        isHeaders: Lt,
        isUndefined: H,
        isDate: Et,
        isFile: gt,
        isBlob: St,
        isRegExp: $t,
        isFunction: C,
        isStream: Ot,
        isURLSearchParams: At,
        isTypedArray: qt,
        isFileList: Rt,
        forEach: W,
        merge: pe,
        extend: _t,
        trim: Pt,
        stripBOM: Ft,
        inherits: Bt,
        toFlatObject: kt,
        kindOf: se,
        kindOfTest: L,
        endsWith: Ut,
        toArray: Dt,
        forEachEntry: It,
        matchAll: jt,
        isHTMLForm: Ht,
        hasOwnProperty: Ce,
        hasOwnProp: Ce,
        reduceDescriptors: Xe,
        freezeMethods: zt,
        toObjectSet: vt,
        toCamelCase: Mt,
        noop: Jt,
        toFiniteNumber: Vt,
        findKey: We,
        global: D,
        isContextDefined: Ke,
        isSpecCompliantForm: Wt,
        toJSONObject: Kt,
        isAsyncFn: Xt,
        isThenable: Gt,
        setImmediate: Ge,
        asap: Qt,
        isIterable: Zt,
    };
function y(e, t, n, r, s) {
    Error.call(this),
        Error.captureStackTrace
            ? Error.captureStackTrace(this, this.constructor)
            : (this.stack = new Error().stack),
        (this.message = e),
        (this.name = "AxiosError"),
        t && (this.code = t),
        n && (this.config = n),
        r && (this.request = r),
        s && ((this.response = s), (this.status = s.status ? s.status : null));
}
a.inherits(y, Error, {
    toJSON: function () {
        return {
            message: this.message,
            name: this.name,
            description: this.description,
            number: this.number,
            fileName: this.fileName,
            lineNumber: this.lineNumber,
            columnNumber: this.columnNumber,
            stack: this.stack,
            config: a.toJSONObject(this.config),
            code: this.code,
            status: this.status,
        };
    },
});
const Qe = y.prototype,
    Ze = {};
[
    "ERR_BAD_OPTION_VALUE",
    "ERR_BAD_OPTION",
    "ECONNABORTED",
    "ETIMEDOUT",
    "ERR_NETWORK",
    "ERR_FR_TOO_MANY_REDIRECTS",
    "ERR_DEPRECATED",
    "ERR_BAD_RESPONSE",
    "ERR_BAD_REQUEST",
    "ERR_CANCELED",
    "ERR_NOT_SUPPORT",
    "ERR_INVALID_URL",
].forEach((e) => {
    Ze[e] = { value: e };
});
Object.defineProperties(y, Ze);
Object.defineProperty(Qe, "isAxiosError", { value: !0 });
y.from = (e, t, n, r, s, i) => {
    const o = Object.create(Qe);
    a.toFlatObject(
        e,
        o,
        function (l) {
            return l !== Error.prototype;
        },
        (f) => f !== "isAxiosError"
    );
    const c = e && e.message ? e.message : "Error",
        p = t == null && e ? e.code : t;
    return (
        y.call(o, c, p, n, r, s),
        e &&
            o.cause == null &&
            Object.defineProperty(o, "cause", { value: e, configurable: !0 }),
        (o.name = (e && e.name) || "Error"),
        i && Object.assign(o, i),
        o
    );
};
const Yt = null;
function he(e) {
    return a.isPlainObject(e) || a.isArray(e);
}
function Ye(e) {
    return a.endsWith(e, "[]") ? e.slice(0, -2) : e;
}
function Ne(e, t, n) {
    return e
        ? e
              .concat(t)
              .map(function (s, i) {
                  return (s = Ye(s)), !n && i ? "[" + s + "]" : s;
              })
              .join(n ? "." : "")
        : t;
}
function en(e) {
    return a.isArray(e) && !e.some(he);
}
const tn = a.toFlatObject(a, {}, null, function (t) {
    return /^is[A-Z]/.test(t);
});
function ie(e, t, n) {
    if (!a.isObject(e)) throw new TypeError("target must be an object");
    (t = t || new FormData()),
        (n = a.toFlatObject(
            n,
            { metaTokens: !0, dots: !1, indexes: !1 },
            !1,
            function (h, d) {
                return !a.isUndefined(d[h]);
            }
        ));
    const r = n.metaTokens,
        s = n.visitor || l,
        i = n.dots,
        o = n.indexes,
        p = (n.Blob || (typeof Blob < "u" && Blob)) && a.isSpecCompliantForm(t);
    if (!a.isFunction(s)) throw new TypeError("visitor must be a function");
    function f(u) {
        if (u === null) return "";
        if (a.isDate(u)) return u.toISOString();
        if (a.isBoolean(u)) return u.toString();
        if (!p && a.isBlob(u))
            throw new y("Blob is not supported. Use a Buffer instead.");
        return a.isArrayBuffer(u) || a.isTypedArray(u)
            ? p && typeof Blob == "function"
                ? new Blob([u])
                : Buffer.from(u)
            : u;
    }
    function l(u, h, d) {
        let E = u;
        if (u && !d && typeof u == "object") {
            if (a.endsWith(h, "{}"))
                (h = r ? h : h.slice(0, -2)), (u = JSON.stringify(u));
            else if (
                (a.isArray(u) && en(u)) ||
                ((a.isFileList(u) || a.endsWith(h, "[]")) && (E = a.toArray(u)))
            )
                return (
                    (h = Ye(h)),
                    E.forEach(function (R, O) {
                        !(a.isUndefined(R) || R === null) &&
                            t.append(
                                o === !0
                                    ? Ne([h], O, i)
                                    : o === null
                                    ? h
                                    : h + "[]",
                                f(R)
                            );
                    }),
                    !1
                );
        }
        return he(u) ? !0 : (t.append(Ne(d, h, i), f(u)), !1);
    }
    const m = [],
        b = Object.assign(tn, {
            defaultVisitor: l,
            convertValue: f,
            isVisitable: he,
        });
    function w(u, h) {
        if (!a.isUndefined(u)) {
            if (m.indexOf(u) !== -1)
                throw Error("Circular reference detected in " + h.join("."));
            m.push(u),
                a.forEach(u, function (E, g) {
                    (!(a.isUndefined(E) || E === null) &&
                        s.call(t, E, a.isString(g) ? g.trim() : g, h, b)) ===
                        !0 && w(E, h ? h.concat(g) : [g]);
                }),
                m.pop();
        }
    }
    if (!a.isObject(e)) throw new TypeError("data must be an object");
    return w(e), t;
}
function Le(e) {
    const t = {
        "!": "%21",
        "'": "%27",
        "(": "%28",
        ")": "%29",
        "~": "%7E",
        "%20": "+",
        "%00": "\0",
    };
    return encodeURIComponent(e).replace(/[!'()~]|%20|%00/g, function (r) {
        return t[r];
    });
}
function Ee(e, t) {
    (this._pairs = []), e && ie(e, this, t);
}
const et = Ee.prototype;
et.append = function (t, n) {
    this._pairs.push([t, n]);
};
et.toString = function (t) {
    const n = t
        ? function (r) {
              return t.call(this, r, Le);
          }
        : Le;
    return this._pairs
        .map(function (s) {
            return n(s[0]) + "=" + n(s[1]);
        }, "")
        .join("&");
};
function nn(e) {
    return encodeURIComponent(e)
        .replace(/%3A/gi, ":")
        .replace(/%24/g, "$")
        .replace(/%2C/gi, ",")
        .replace(/%20/g, "+");
}
function tt(e, t, n) {
    if (!t) return e;
    const r = (n && n.encode) || nn;
    a.isFunction(n) && (n = { serialize: n });
    const s = n && n.serialize;
    let i;
    if (
        (s
            ? (i = s(t, n))
            : (i = a.isURLSearchParams(t)
                  ? t.toString()
                  : new Ee(t, n).toString(r)),
        i)
    ) {
        const o = e.indexOf("#");
        o !== -1 && (e = e.slice(0, o)),
            (e += (e.indexOf("?") === -1 ? "?" : "&") + i);
    }
    return e;
}
class Pe {
    constructor() {
        this.handlers = [];
    }
    use(t, n, r) {
        return (
            this.handlers.push({
                fulfilled: t,
                rejected: n,
                synchronous: r ? r.synchronous : !1,
                runWhen: r ? r.runWhen : null,
            }),
            this.handlers.length - 1
        );
    }
    eject(t) {
        this.handlers[t] && (this.handlers[t] = null);
    }
    clear() {
        this.handlers && (this.handlers = []);
    }
    forEach(t) {
        a.forEach(this.handlers, function (r) {
            r !== null && t(r);
        });
    }
}
const nt = {
        silentJSONParsing: !0,
        forcedJSONParsing: !0,
        clarifyTimeoutError: !1,
    },
    rn = typeof URLSearchParams < "u" ? URLSearchParams : Ee,
    sn = typeof FormData < "u" ? FormData : null,
    on = typeof Blob < "u" ? Blob : null,
    an = {
        isBrowser: !0,
        classes: { URLSearchParams: rn, FormData: sn, Blob: on },
        protocols: ["http", "https", "file", "blob", "url", "data"],
    },
    ge = typeof window < "u" && typeof document < "u",
    me = (typeof navigator == "object" && navigator) || void 0,
    cn =
        ge &&
        (!me || ["ReactNative", "NativeScript", "NS"].indexOf(me.product) < 0),
    ln =
        typeof WorkerGlobalScope < "u" &&
        self instanceof WorkerGlobalScope &&
        typeof self.importScripts == "function",
    un = (ge && window.location.href) || "http://localhost",
    fn = Object.freeze(
        Object.defineProperty(
            {
                __proto__: null,
                hasBrowserEnv: ge,
                hasStandardBrowserEnv: cn,
                hasStandardBrowserWebWorkerEnv: ln,
                navigator: me,
                origin: un,
            },
            Symbol.toStringTag,
            { value: "Module" }
        )
    ),
    T = { ...fn, ...an };
function dn(e, t) {
    return ie(e, new T.classes.URLSearchParams(), {
        visitor: function (n, r, s, i) {
            return T.isNode && a.isBuffer(n)
                ? (this.append(r, n.toString("base64")), !1)
                : i.defaultVisitor.apply(this, arguments);
        },
        ...t,
    });
}
function pn(e) {
    return a
        .matchAll(/\w+|\[(\w*)]/g, e)
        .map((t) => (t[0] === "[]" ? "" : t[1] || t[0]));
}
function hn(e) {
    const t = {},
        n = Object.keys(e);
    let r;
    const s = n.length;
    let i;
    for (r = 0; r < s; r++) (i = n[r]), (t[i] = e[i]);
    return t;
}
function rt(e) {
    function t(n, r, s, i) {
        let o = n[i++];
        if (o === "__proto__") return !0;
        const c = Number.isFinite(+o),
            p = i >= n.length;
        return (
            (o = !o && a.isArray(s) ? s.length : o),
            p
                ? (a.hasOwnProp(s, o) ? (s[o] = [s[o], r]) : (s[o] = r), !c)
                : ((!s[o] || !a.isObject(s[o])) && (s[o] = []),
                  t(n, r, s[o], i) && a.isArray(s[o]) && (s[o] = hn(s[o])),
                  !c)
        );
    }
    if (a.isFormData(e) && a.isFunction(e.entries)) {
        const n = {};
        return (
            a.forEachEntry(e, (r, s) => {
                t(pn(r), s, n, 0);
            }),
            n
        );
    }
    return null;
}
function mn(e, t, n) {
    if (a.isString(e))
        try {
            return (t || JSON.parse)(e), a.trim(e);
        } catch (r) {
            if (r.name !== "SyntaxError") throw r;
        }
    return (n || JSON.stringify)(e);
}
const K = {
    transitional: nt,
    adapter: ["xhr", "http", "fetch"],
    transformRequest: [
        function (t, n) {
            const r = n.getContentType() || "",
                s = r.indexOf("application/json") > -1,
                i = a.isObject(t);
            if (
                (i && a.isHTMLForm(t) && (t = new FormData(t)), a.isFormData(t))
            )
                return s ? JSON.stringify(rt(t)) : t;
            if (
                a.isArrayBuffer(t) ||
                a.isBuffer(t) ||
                a.isStream(t) ||
                a.isFile(t) ||
                a.isBlob(t) ||
                a.isReadableStream(t)
            )
                return t;
            if (a.isArrayBufferView(t)) return t.buffer;
            if (a.isURLSearchParams(t))
                return (
                    n.setContentType(
                        "application/x-www-form-urlencoded;charset=utf-8",
                        !1
                    ),
                    t.toString()
                );
            let c;
            if (i) {
                if (r.indexOf("application/x-www-form-urlencoded") > -1)
                    return dn(t, this.formSerializer).toString();
                if (
                    (c = a.isFileList(t)) ||
                    r.indexOf("multipart/form-data") > -1
                ) {
                    const p = this.env && this.env.FormData;
                    return ie(
                        c ? { "files[]": t } : t,
                        p && new p(),
                        this.formSerializer
                    );
                }
            }
            return i || s
                ? (n.setContentType("application/json", !1), mn(t))
                : t;
        },
    ],
    transformResponse: [
        function (t) {
            const n = this.transitional || K.transitional,
                r = n && n.forcedJSONParsing,
                s = this.responseType === "json";
            if (a.isResponse(t) || a.isReadableStream(t)) return t;
            if (t && a.isString(t) && ((r && !this.responseType) || s)) {
                const o = !(n && n.silentJSONParsing) && s;
                try {
                    return JSON.parse(t, this.parseReviver);
                } catch (c) {
                    if (o)
                        throw c.name === "SyntaxError"
                            ? y.from(
                                  c,
                                  y.ERR_BAD_RESPONSE,
                                  this,
                                  null,
                                  this.response
                              )
                            : c;
                }
            }
            return t;
        },
    ],
    timeout: 0,
    xsrfCookieName: "XSRF-TOKEN",
    xsrfHeaderName: "X-XSRF-TOKEN",
    maxContentLength: -1,
    maxBodyLength: -1,
    env: { FormData: T.classes.FormData, Blob: T.classes.Blob },
    validateStatus: function (t) {
        return t >= 200 && t < 300;
    },
    headers: {
        common: {
            Accept: "application/json, text/plain, */*",
            "Content-Type": void 0,
        },
    },
};
a.forEach(["delete", "get", "head", "post", "put", "patch"], (e) => {
    K.headers[e] = {};
});
const yn = a.toObjectSet([
        "age",
        "authorization",
        "content-length",
        "content-type",
        "etag",
        "expires",
        "from",
        "host",
        "if-modified-since",
        "if-unmodified-since",
        "last-modified",
        "location",
        "max-forwards",
        "proxy-authorization",
        "referer",
        "retry-after",
        "user-agent",
    ]),
    bn = (e) => {
        const t = {};
        let n, r, s;
        return (
            e &&
                e
                    .split(
                        `
`
                    )
                    .forEach(function (o) {
                        (s = o.indexOf(":")),
                            (n = o.substring(0, s).trim().toLowerCase()),
                            (r = o.substring(s + 1).trim()),
                            !(!n || (t[n] && yn[n])) &&
                                (n === "set-cookie"
                                    ? t[n]
                                        ? t[n].push(r)
                                        : (t[n] = [r])
                                    : (t[n] = t[n] ? t[n] + ", " + r : r));
                    }),
            t
        );
    },
    _e = Symbol("internals");
function v(e) {
    return e && String(e).trim().toLowerCase();
}
function ee(e) {
    return e === !1 || e == null ? e : a.isArray(e) ? e.map(ee) : String(e);
}
function wn(e) {
    const t = Object.create(null),
        n = /([^\s,;=]+)\s*(?:=\s*([^,;]+))?/g;
    let r;
    for (; (r = n.exec(e)); ) t[r[1]] = r[2];
    return t;
}
const En = (e) => /^[-_a-zA-Z0-9^`|~,!#$%&'*+.]+$/.test(e.trim());
function ue(e, t, n, r, s) {
    if (a.isFunction(r)) return r.call(this, t, n);
    if ((s && (t = n), !!a.isString(t))) {
        if (a.isString(r)) return t.indexOf(r) !== -1;
        if (a.isRegExp(r)) return r.test(t);
    }
}
function gn(e) {
    return e
        .trim()
        .toLowerCase()
        .replace(/([a-z\d])(\w*)/g, (t, n, r) => n.toUpperCase() + r);
}
function Sn(e, t) {
    const n = a.toCamelCase(" " + t);
    ["get", "set", "has"].forEach((r) => {
        Object.defineProperty(e, r + n, {
            value: function (s, i, o) {
                return this[r].call(this, t, s, i, o);
            },
            configurable: !0,
        });
    });
}
let N = class {
    constructor(t) {
        t && this.set(t);
    }
    set(t, n, r) {
        const s = this;
        function i(c, p, f) {
            const l = v(p);
            if (!l) throw new Error("header name must be a non-empty string");
            const m = a.findKey(s, l);
            (!m ||
                s[m] === void 0 ||
                f === !0 ||
                (f === void 0 && s[m] !== !1)) &&
                (s[m || p] = ee(c));
        }
        const o = (c, p) => a.forEach(c, (f, l) => i(f, l, p));
        if (a.isPlainObject(t) || t instanceof this.constructor) o(t, n);
        else if (a.isString(t) && (t = t.trim()) && !En(t)) o(bn(t), n);
        else if (a.isObject(t) && a.isIterable(t)) {
            let c = {},
                p,
                f;
            for (const l of t) {
                if (!a.isArray(l))
                    throw TypeError(
                        "Object iterator must return a key-value pair"
                    );
                c[(f = l[0])] = (p = c[f])
                    ? a.isArray(p)
                        ? [...p, l[1]]
                        : [p, l[1]]
                    : l[1];
            }
            o(c, n);
        } else t != null && i(n, t, r);
        return this;
    }
    get(t, n) {
        if (((t = v(t)), t)) {
            const r = a.findKey(this, t);
            if (r) {
                const s = this[r];
                if (!n) return s;
                if (n === !0) return wn(s);
                if (a.isFunction(n)) return n.call(this, s, r);
                if (a.isRegExp(n)) return n.exec(s);
                throw new TypeError("parser must be boolean|regexp|function");
            }
        }
    }
    has(t, n) {
        if (((t = v(t)), t)) {
            const r = a.findKey(this, t);
            return !!(
                r &&
                this[r] !== void 0 &&
                (!n || ue(this, this[r], r, n))
            );
        }
        return !1;
    }
    delete(t, n) {
        const r = this;
        let s = !1;
        function i(o) {
            if (((o = v(o)), o)) {
                const c = a.findKey(r, o);
                c && (!n || ue(r, r[c], c, n)) && (delete r[c], (s = !0));
            }
        }
        return a.isArray(t) ? t.forEach(i) : i(t), s;
    }
    clear(t) {
        const n = Object.keys(this);
        let r = n.length,
            s = !1;
        for (; r--; ) {
            const i = n[r];
            (!t || ue(this, this[i], i, t, !0)) && (delete this[i], (s = !0));
        }
        return s;
    }
    normalize(t) {
        const n = this,
            r = {};
        return (
            a.forEach(this, (s, i) => {
                const o = a.findKey(r, i);
                if (o) {
                    (n[o] = ee(s)), delete n[i];
                    return;
                }
                const c = t ? gn(i) : String(i).trim();
                c !== i && delete n[i], (n[c] = ee(s)), (r[c] = !0);
            }),
            this
        );
    }
    concat(...t) {
        return this.constructor.concat(this, ...t);
    }
    toJSON(t) {
        const n = Object.create(null);
        return (
            a.forEach(this, (r, s) => {
                r != null &&
                    r !== !1 &&
                    (n[s] = t && a.isArray(r) ? r.join(", ") : r);
            }),
            n
        );
    }
    [Symbol.iterator]() {
        return Object.entries(this.toJSON())[Symbol.iterator]();
    }
    toString() {
        return Object.entries(this.toJSON()).map(([t, n]) => t + ": " + n)
            .join(`
`);
    }
    getSetCookie() {
        return this.get("set-cookie") || [];
    }
    get [Symbol.toStringTag]() {
        return "AxiosHeaders";
    }
    static from(t) {
        return t instanceof this ? t : new this(t);
    }
    static concat(t, ...n) {
        const r = new this(t);
        return n.forEach((s) => r.set(s)), r;
    }
    static accessor(t) {
        const r = (this[_e] = this[_e] = { accessors: {} }).accessors,
            s = this.prototype;
        function i(o) {
            const c = v(o);
            r[c] || (Sn(s, o), (r[c] = !0));
        }
        return a.isArray(t) ? t.forEach(i) : i(t), this;
    }
};
N.accessor([
    "Content-Type",
    "Content-Length",
    "Accept",
    "Accept-Encoding",
    "User-Agent",
    "Authorization",
]);
a.reduceDescriptors(N.prototype, ({ value: e }, t) => {
    let n = t[0].toUpperCase() + t.slice(1);
    return {
        get: () => e,
        set(r) {
            this[n] = r;
        },
    };
});
a.freezeMethods(N);
function fe(e, t) {
    const n = this || K,
        r = t || n,
        s = N.from(r.headers);
    let i = r.data;
    return (
        a.forEach(e, function (c) {
            i = c.call(n, i, s.normalize(), t ? t.status : void 0);
        }),
        s.normalize(),
        i
    );
}
function st(e) {
    return !!(e && e.__CANCEL__);
}
function $(e, t, n) {
    y.call(this, e ?? "canceled", y.ERR_CANCELED, t, n),
        (this.name = "CanceledError");
}
a.inherits($, y, { __CANCEL__: !0 });
function ot(e, t, n) {
    const r = n.config.validateStatus;
    !n.status || !r || r(n.status)
        ? e(n)
        : t(
              new y(
                  "Request failed with status code " + n.status,
                  [y.ERR_BAD_REQUEST, y.ERR_BAD_RESPONSE][
                      Math.floor(n.status / 100) - 4
                  ],
                  n.config,
                  n.request,
                  n
              )
          );
}
function Rn(e) {
    const t = /^([-+\w]{1,25})(:?\/\/|:)/.exec(e);
    return (t && t[1]) || "";
}
function On(e, t) {
    e = e || 10;
    const n = new Array(e),
        r = new Array(e);
    let s = 0,
        i = 0,
        o;
    return (
        (t = t !== void 0 ? t : 1e3),
        function (p) {
            const f = Date.now(),
                l = r[i];
            o || (o = f), (n[s] = p), (r[s] = f);
            let m = i,
                b = 0;
            for (; m !== s; ) (b += n[m++]), (m = m % e);
            if (((s = (s + 1) % e), s === i && (i = (i + 1) % e), f - o < t))
                return;
            const w = l && f - l;
            return w ? Math.round((b * 1e3) / w) : void 0;
        }
    );
}
function Tn(e, t) {
    let n = 0,
        r = 1e3 / t,
        s,
        i;
    const o = (f, l = Date.now()) => {
        (n = l), (s = null), i && (clearTimeout(i), (i = null)), e(...f);
    };
    return [
        (...f) => {
            const l = Date.now(),
                m = l - n;
            m >= r
                ? o(f, l)
                : ((s = f),
                  i ||
                      (i = setTimeout(() => {
                          (i = null), o(s);
                      }, r - m)));
        },
        () => s && o(s),
    ];
}
const ne = (e, t, n = 3) => {
        let r = 0;
        const s = On(50, 250);
        return Tn((i) => {
            const o = i.loaded,
                c = i.lengthComputable ? i.total : void 0,
                p = o - r,
                f = s(p),
                l = o <= c;
            r = o;
            const m = {
                loaded: o,
                total: c,
                progress: c ? o / c : void 0,
                bytes: p,
                rate: f || void 0,
                estimated: f && c && l ? (c - o) / f : void 0,
                event: i,
                lengthComputable: c != null,
                [t ? "download" : "upload"]: !0,
            };
            e(m);
        }, n);
    },
    Fe = (e, t) => {
        const n = e != null;
        return [
            (r) => t[0]({ lengthComputable: n, total: e, loaded: r }),
            t[1],
        ];
    },
    Be =
        (e) =>
        (...t) =>
            a.asap(() => e(...t)),
    An = T.hasStandardBrowserEnv
        ? ((e, t) => (n) => (
              (n = new URL(n, T.origin)),
              e.protocol === n.protocol &&
                  e.host === n.host &&
                  (t || e.port === n.port)
          ))(
              new URL(T.origin),
              T.navigator && /(msie|trident)/i.test(T.navigator.userAgent)
          )
        : () => !0,
    xn = T.hasStandardBrowserEnv
        ? {
              write(e, t, n, r, s, i) {
                  const o = [e + "=" + encodeURIComponent(t)];
                  a.isNumber(n) &&
                      o.push("expires=" + new Date(n).toGMTString()),
                      a.isString(r) && o.push("path=" + r),
                      a.isString(s) && o.push("domain=" + s),
                      i === !0 && o.push("secure"),
                      (document.cookie = o.join("; "));
              },
              read(e) {
                  const t = document.cookie.match(
                      new RegExp("(^|;\\s*)(" + e + ")=([^;]*)")
                  );
                  return t ? decodeURIComponent(t[3]) : null;
              },
              remove(e) {
                  this.write(e, "", Date.now() - 864e5);
              },
          }
        : {
              write() {},
              read() {
                  return null;
              },
              remove() {},
          };
function Cn(e) {
    return /^([a-z][a-z\d+\-.]*:)?\/\//i.test(e);
}
function Nn(e, t) {
    return t ? e.replace(/\/?\/$/, "") + "/" + t.replace(/^\/+/, "") : e;
}
function it(e, t, n) {
    let r = !Cn(t);
    return e && (r || n == !1) ? Nn(e, t) : t;
}
const ke = (e) => (e instanceof N ? { ...e } : e);
function I(e, t) {
    t = t || {};
    const n = {};
    function r(f, l, m, b) {
        return a.isPlainObject(f) && a.isPlainObject(l)
            ? a.merge.call({ caseless: b }, f, l)
            : a.isPlainObject(l)
            ? a.merge({}, l)
            : a.isArray(l)
            ? l.slice()
            : l;
    }
    function s(f, l, m, b) {
        if (a.isUndefined(l)) {
            if (!a.isUndefined(f)) return r(void 0, f, m, b);
        } else return r(f, l, m, b);
    }
    function i(f, l) {
        if (!a.isUndefined(l)) return r(void 0, l);
    }
    function o(f, l) {
        if (a.isUndefined(l)) {
            if (!a.isUndefined(f)) return r(void 0, f);
        } else return r(void 0, l);
    }
    function c(f, l, m) {
        if (m in t) return r(f, l);
        if (m in e) return r(void 0, f);
    }
    const p = {
        url: i,
        method: i,
        data: i,
        baseURL: o,
        transformRequest: o,
        transformResponse: o,
        paramsSerializer: o,
        timeout: o,
        timeoutMessage: o,
        withCredentials: o,
        withXSRFToken: o,
        adapter: o,
        responseType: o,
        xsrfCookieName: o,
        xsrfHeaderName: o,
        onUploadProgress: o,
        onDownloadProgress: o,
        decompress: o,
        maxContentLength: o,
        maxBodyLength: o,
        beforeRedirect: o,
        transport: o,
        httpAgent: o,
        httpsAgent: o,
        cancelToken: o,
        socketPath: o,
        responseEncoding: o,
        validateStatus: c,
        headers: (f, l, m) => s(ke(f), ke(l), m, !0),
    };
    return (
        a.forEach(Object.keys({ ...e, ...t }), function (l) {
            const m = p[l] || s,
                b = m(e[l], t[l], l);
            (a.isUndefined(b) && m !== c) || (n[l] = b);
        }),
        n
    );
}
const at = (e) => {
        const t = I({}, e);
        let {
            data: n,
            withXSRFToken: r,
            xsrfHeaderName: s,
            xsrfCookieName: i,
            headers: o,
            auth: c,
        } = t;
        if (
            ((t.headers = o = N.from(o)),
            (t.url = tt(
                it(t.baseURL, t.url, t.allowAbsoluteUrls),
                e.params,
                e.paramsSerializer
            )),
            c &&
                o.set(
                    "Authorization",
                    "Basic " +
                        btoa(
                            (c.username || "") +
                                ":" +
                                (c.password
                                    ? unescape(encodeURIComponent(c.password))
                                    : "")
                        )
                ),
            a.isFormData(n))
        ) {
            if (T.hasStandardBrowserEnv || T.hasStandardBrowserWebWorkerEnv)
                o.setContentType(void 0);
            else if (a.isFunction(n.getHeaders)) {
                const p = n.getHeaders(),
                    f = ["content-type", "content-length"];
                Object.entries(p).forEach(([l, m]) => {
                    f.includes(l.toLowerCase()) && o.set(l, m);
                });
            }
        }
        if (
            T.hasStandardBrowserEnv &&
            (r && a.isFunction(r) && (r = r(t)), r || (r !== !1 && An(t.url)))
        ) {
            const p = s && i && xn.read(i);
            p && o.set(s, p);
        }
        return t;
    },
    Ln = typeof XMLHttpRequest < "u",
    Pn =
        Ln &&
        function (e) {
            return new Promise(function (n, r) {
                const s = at(e);
                let i = s.data;
                const o = N.from(s.headers).normalize();
                let {
                        responseType: c,
                        onUploadProgress: p,
                        onDownloadProgress: f,
                    } = s,
                    l,
                    m,
                    b,
                    w,
                    u;
                function h() {
                    w && w(),
                        u && u(),
                        s.cancelToken && s.cancelToken.unsubscribe(l),
                        s.signal && s.signal.removeEventListener("abort", l);
                }
                let d = new XMLHttpRequest();
                d.open(s.method.toUpperCase(), s.url, !0),
                    (d.timeout = s.timeout);
                function E() {
                    if (!d) return;
                    const R = N.from(
                            "getAllResponseHeaders" in d &&
                                d.getAllResponseHeaders()
                        ),
                        A = {
                            data:
                                !c || c === "text" || c === "json"
                                    ? d.responseText
                                    : d.response,
                            status: d.status,
                            statusText: d.statusText,
                            headers: R,
                            config: e,
                            request: d,
                        };
                    ot(
                        function (x) {
                            n(x), h();
                        },
                        function (x) {
                            r(x), h();
                        },
                        A
                    ),
                        (d = null);
                }
                "onloadend" in d
                    ? (d.onloadend = E)
                    : (d.onreadystatechange = function () {
                          !d ||
                              d.readyState !== 4 ||
                              (d.status === 0 &&
                                  !(
                                      d.responseURL &&
                                      d.responseURL.indexOf("file:") === 0
                                  )) ||
                              setTimeout(E);
                      }),
                    (d.onabort = function () {
                        d &&
                            (r(new y("Request aborted", y.ECONNABORTED, e, d)),
                            (d = null));
                    }),
                    (d.onerror = function (O) {
                        const A = O && O.message ? O.message : "Network Error",
                            P = new y(A, y.ERR_NETWORK, e, d);
                        (P.event = O || null), r(P), (d = null);
                    }),
                    (d.ontimeout = function () {
                        let O = s.timeout
                            ? "timeout of " + s.timeout + "ms exceeded"
                            : "timeout exceeded";
                        const A = s.transitional || nt;
                        s.timeoutErrorMessage && (O = s.timeoutErrorMessage),
                            r(
                                new y(
                                    O,
                                    A.clarifyTimeoutError
                                        ? y.ETIMEDOUT
                                        : y.ECONNABORTED,
                                    e,
                                    d
                                )
                            ),
                            (d = null);
                    }),
                    i === void 0 && o.setContentType(null),
                    "setRequestHeader" in d &&
                        a.forEach(o.toJSON(), function (O, A) {
                            d.setRequestHeader(A, O);
                        }),
                    a.isUndefined(s.withCredentials) ||
                        (d.withCredentials = !!s.withCredentials),
                    c && c !== "json" && (d.responseType = s.responseType),
                    f &&
                        (([b, u] = ne(f, !0)),
                        d.addEventListener("progress", b)),
                    p &&
                        d.upload &&
                        (([m, w] = ne(p)),
                        d.upload.addEventListener("progress", m),
                        d.upload.addEventListener("loadend", w)),
                    (s.cancelToken || s.signal) &&
                        ((l = (R) => {
                            d &&
                                (r(!R || R.type ? new $(null, e, d) : R),
                                d.abort(),
                                (d = null));
                        }),
                        s.cancelToken && s.cancelToken.subscribe(l),
                        s.signal &&
                            (s.signal.aborted
                                ? l()
                                : s.signal.addEventListener("abort", l)));
                const g = Rn(s.url);
                if (g && T.protocols.indexOf(g) === -1) {
                    r(
                        new y(
                            "Unsupported protocol " + g + ":",
                            y.ERR_BAD_REQUEST,
                            e
                        )
                    );
                    return;
                }
                d.send(i || null);
            });
        },
    _n = (e, t) => {
        const { length: n } = (e = e ? e.filter(Boolean) : []);
        if (t || n) {
            let r = new AbortController(),
                s;
            const i = function (f) {
                if (!s) {
                    (s = !0), c();
                    const l = f instanceof Error ? f : this.reason;
                    r.abort(
                        l instanceof y
                            ? l
                            : new $(l instanceof Error ? l.message : l)
                    );
                }
            };
            let o =
                t &&
                setTimeout(() => {
                    (o = null),
                        i(new y(`timeout ${t} of ms exceeded`, y.ETIMEDOUT));
                }, t);
            const c = () => {
                e &&
                    (o && clearTimeout(o),
                    (o = null),
                    e.forEach((f) => {
                        f.unsubscribe
                            ? f.unsubscribe(i)
                            : f.removeEventListener("abort", i);
                    }),
                    (e = null));
            };
            e.forEach((f) => f.addEventListener("abort", i));
            const { signal: p } = r;
            return (p.unsubscribe = () => a.asap(c)), p;
        }
    },
    Fn = function* (e, t) {
        let n = e.byteLength;
        if (n < t) {
            yield e;
            return;
        }
        let r = 0,
            s;
        for (; r < n; ) (s = r + t), yield e.slice(r, s), (r = s);
    },
    Bn = async function* (e, t) {
        for await (const n of kn(e)) yield* Fn(n, t);
    },
    kn = async function* (e) {
        if (e[Symbol.asyncIterator]) {
            yield* e;
            return;
        }
        const t = e.getReader();
        try {
            for (;;) {
                const { done: n, value: r } = await t.read();
                if (n) break;
                yield r;
            }
        } finally {
            await t.cancel();
        }
    },
    Ue = (e, t, n, r) => {
        const s = Bn(e, t);
        let i = 0,
            o,
            c = (p) => {
                o || ((o = !0), r && r(p));
            };
        return new ReadableStream(
            {
                async pull(p) {
                    try {
                        const { done: f, value: l } = await s.next();
                        if (f) {
                            c(), p.close();
                            return;
                        }
                        let m = l.byteLength;
                        if (n) {
                            let b = (i += m);
                            n(b);
                        }
                        p.enqueue(new Uint8Array(l));
                    } catch (f) {
                        throw (c(f), f);
                    }
                },
                cancel(p) {
                    return c(p), s.return();
                },
            },
            { highWaterMark: 2 }
        );
    },
    De = 64 * 1024,
    { isFunction: Z } = a,
    Un = (({ Request: e, Response: t }) => ({ Request: e, Response: t }))(
        a.global
    ),
    { ReadableStream: qe, TextEncoder: Ie } = a.global,
    je = (e, ...t) => {
        try {
            return !!e(...t);
        } catch {
            return !1;
        }
    },
    Dn = (e) => {
        e = a.merge.call({ skipUndefined: !0 }, Un, e);
        const { fetch: t, Request: n, Response: r } = e,
            s = t ? Z(t) : typeof fetch == "function",
            i = Z(n),
            o = Z(r);
        if (!s) return !1;
        const c = s && Z(qe),
            p =
                s &&
                (typeof Ie == "function"
                    ? (
                          (u) => (h) =>
                              u.encode(h)
                      )(new Ie())
                    : async (u) =>
                          new Uint8Array(await new n(u).arrayBuffer())),
            f =
                i &&
                c &&
                je(() => {
                    let u = !1;
                    const h = new n(T.origin, {
                        body: new qe(),
                        method: "POST",
                        get duplex() {
                            return (u = !0), "half";
                        },
                    }).headers.has("Content-Type");
                    return u && !h;
                }),
            l = o && c && je(() => a.isReadableStream(new r("").body)),
            m = { stream: l && ((u) => u.body) };
        s &&
            ["text", "arrayBuffer", "blob", "formData", "stream"].forEach(
                (u) => {
                    !m[u] &&
                        (m[u] = (h, d) => {
                            let E = h && h[u];
                            if (E) return E.call(h);
                            throw new y(
                                `Response type '${u}' is not supported`,
                                y.ERR_NOT_SUPPORT,
                                d
                            );
                        });
                }
            );
        const b = async (u) => {
                if (u == null) return 0;
                if (a.isBlob(u)) return u.size;
                if (a.isSpecCompliantForm(u))
                    return (
                        await new n(T.origin, {
                            method: "POST",
                            body: u,
                        }).arrayBuffer()
                    ).byteLength;
                if (a.isArrayBufferView(u) || a.isArrayBuffer(u))
                    return u.byteLength;
                if ((a.isURLSearchParams(u) && (u = u + ""), a.isString(u)))
                    return (await p(u)).byteLength;
            },
            w = async (u, h) => {
                const d = a.toFiniteNumber(u.getContentLength());
                return d ?? b(h);
            };
        return async (u) => {
            let {
                    url: h,
                    method: d,
                    data: E,
                    signal: g,
                    cancelToken: R,
                    timeout: O,
                    onDownloadProgress: A,
                    onUploadProgress: P,
                    responseType: x,
                    headers: ce,
                    withCredentials: X = "same-origin",
                    fetchOptions: Se,
                } = at(u),
                Re = t || fetch;
            x = x ? (x + "").toLowerCase() : "text";
            let G = _n([g, R && R.toAbortSignal()], O),
                z = null;
            const U =
                G &&
                G.unsubscribe &&
                (() => {
                    G.unsubscribe();
                });
            let Oe;
            try {
                if (
                    P &&
                    f &&
                    d !== "get" &&
                    d !== "head" &&
                    (Oe = await w(ce, E)) !== 0
                ) {
                    let k = new n(h, {
                            method: "POST",
                            body: E,
                            duplex: "half",
                        }),
                        j;
                    if (
                        (a.isFormData(E) &&
                            (j = k.headers.get("content-type")) &&
                            ce.setContentType(j),
                        k.body)
                    ) {
                        const [le, Q] = Fe(Oe, ne(Be(P)));
                        E = Ue(k.body, De, le, Q);
                    }
                }
                a.isString(X) || (X = X ? "include" : "omit");
                const _ = i && "credentials" in n.prototype,
                    Te = {
                        ...Se,
                        signal: G,
                        method: d.toUpperCase(),
                        headers: ce.normalize().toJSON(),
                        body: E,
                        duplex: "half",
                        credentials: _ ? X : void 0,
                    };
                z = i && new n(h, Te);
                let B = await (i ? Re(z, Se) : Re(h, Te));
                const Ae = l && (x === "stream" || x === "response");
                if (l && (A || (Ae && U))) {
                    const k = {};
                    ["status", "statusText", "headers"].forEach((xe) => {
                        k[xe] = B[xe];
                    });
                    const j = a.toFiniteNumber(B.headers.get("content-length")),
                        [le, Q] = (A && Fe(j, ne(Be(A), !0))) || [];
                    B = new r(
                        Ue(B.body, De, le, () => {
                            Q && Q(), U && U();
                        }),
                        k
                    );
                }
                x = x || "text";
                let pt = await m[a.findKey(m, x) || "text"](B, u);
                return (
                    !Ae && U && U(),
                    await new Promise((k, j) => {
                        ot(k, j, {
                            data: pt,
                            headers: N.from(B.headers),
                            status: B.status,
                            statusText: B.statusText,
                            config: u,
                            request: z,
                        });
                    })
                );
            } catch (_) {
                throw (
                    (U && U(),
                    _ &&
                    _.name === "TypeError" &&
                    /Load failed|fetch/i.test(_.message)
                        ? Object.assign(
                              new y("Network Error", y.ERR_NETWORK, u, z),
                              { cause: _.cause || _ }
                          )
                        : y.from(_, _ && _.code, u, z))
                );
            }
        };
    },
    qn = new Map(),
    ct = (e) => {
        let t = e ? e.env : {};
        const { fetch: n, Request: r, Response: s } = t,
            i = [r, s, n];
        let o = i.length,
            c = o,
            p,
            f,
            l = qn;
        for (; c--; )
            (p = i[c]),
                (f = l.get(p)),
                f === void 0 && l.set(p, (f = c ? new Map() : Dn(t))),
                (l = f);
        return f;
    };
ct();
const ye = { http: Yt, xhr: Pn, fetch: { get: ct } };
a.forEach(ye, (e, t) => {
    if (e) {
        try {
            Object.defineProperty(e, "name", { value: t });
        } catch {}
        Object.defineProperty(e, "adapterName", { value: t });
    }
});
const He = (e) => `- ${e}`,
    In = (e) => a.isFunction(e) || e === null || e === !1,
    lt = {
        getAdapter: (e, t) => {
            e = a.isArray(e) ? e : [e];
            const { length: n } = e;
            let r, s;
            const i = {};
            for (let o = 0; o < n; o++) {
                r = e[o];
                let c;
                if (
                    ((s = r),
                    !In(r) &&
                        ((s = ye[(c = String(r)).toLowerCase()]), s === void 0))
                )
                    throw new y(`Unknown adapter '${c}'`);
                if (s && (a.isFunction(s) || (s = s.get(t)))) break;
                i[c || "#" + o] = s;
            }
            if (!s) {
                const o = Object.entries(i).map(
                    ([p, f]) =>
                        `adapter ${p} ` +
                        (f === !1
                            ? "is not supported by the environment"
                            : "is not available in the build")
                );
                let c = n
                    ? o.length > 1
                        ? `since :
` +
                          o.map(He).join(`
`)
                        : " " + He(o[0])
                    : "as no adapter specified";
                throw new y(
                    "There is no suitable adapter to dispatch the request " + c,
                    "ERR_NOT_SUPPORT"
                );
            }
            return s;
        },
        adapters: ye,
    };
function de(e) {
    if (
        (e.cancelToken && e.cancelToken.throwIfRequested(),
        e.signal && e.signal.aborted)
    )
        throw new $(null, e);
}
function Me(e) {
    return (
        de(e),
        (e.headers = N.from(e.headers)),
        (e.data = fe.call(e, e.transformRequest)),
        ["post", "put", "patch"].indexOf(e.method) !== -1 &&
            e.headers.setContentType("application/x-www-form-urlencoded", !1),
        lt
            .getAdapter(
                e.adapter || K.adapter,
                e
            )(e)
            .then(
                function (r) {
                    return (
                        de(e),
                        (r.data = fe.call(e, e.transformResponse, r)),
                        (r.headers = N.from(r.headers)),
                        r
                    );
                },
                function (r) {
                    return (
                        st(r) ||
                            (de(e),
                            r &&
                                r.response &&
                                ((r.response.data = fe.call(
                                    e,
                                    e.transformResponse,
                                    r.response
                                )),
                                (r.response.headers = N.from(
                                    r.response.headers
                                )))),
                        Promise.reject(r)
                    );
                }
            )
    );
}
const ut = "1.12.2",
    ae = {};
["object", "boolean", "number", "function", "string", "symbol"].forEach(
    (e, t) => {
        ae[e] = function (r) {
            return typeof r === e || "a" + (t < 1 ? "n " : " ") + e;
        };
    }
);
const $e = {};
ae.transitional = function (t, n, r) {
    function s(i, o) {
        return (
            "[Axios v" +
            ut +
            "] Transitional option '" +
            i +
            "'" +
            o +
            (r ? ". " + r : "")
        );
    }
    return (i, o, c) => {
        if (t === !1)
            throw new y(
                s(o, " has been removed" + (n ? " in " + n : "")),
                y.ERR_DEPRECATED
            );
        return (
            n &&
                !$e[o] &&
                (($e[o] = !0),
                console.warn(
                    s(
                        o,
                        " has been deprecated since v" +
                            n +
                            " and will be removed in the near future"
                    )
                )),
            t ? t(i, o, c) : !0
        );
    };
};
ae.spelling = function (t) {
    return (n, r) => (console.warn(`${r} is likely a misspelling of ${t}`), !0);
};
function jn(e, t, n) {
    if (typeof e != "object")
        throw new y("options must be an object", y.ERR_BAD_OPTION_VALUE);
    const r = Object.keys(e);
    let s = r.length;
    for (; s-- > 0; ) {
        const i = r[s],
            o = t[i];
        if (o) {
            const c = e[i],
                p = c === void 0 || o(c, i, e);
            if (p !== !0)
                throw new y(
                    "option " + i + " must be " + p,
                    y.ERR_BAD_OPTION_VALUE
                );
            continue;
        }
        if (n !== !0) throw new y("Unknown option " + i, y.ERR_BAD_OPTION);
    }
}
const te = { assertOptions: jn, validators: ae },
    F = te.validators;
let q = class {
    constructor(t) {
        (this.defaults = t || {}),
            (this.interceptors = { request: new Pe(), response: new Pe() });
    }
    async request(t, n) {
        try {
            return await this._request(t, n);
        } catch (r) {
            if (r instanceof Error) {
                let s = {};
                Error.captureStackTrace
                    ? Error.captureStackTrace(s)
                    : (s = new Error());
                const i = s.stack ? s.stack.replace(/^.+\n/, "") : "";
                try {
                    r.stack
                        ? i &&
                          !String(r.stack).endsWith(
                              i.replace(/^.+\n.+\n/, "")
                          ) &&
                          (r.stack +=
                              `
` + i)
                        : (r.stack = i);
                } catch {}
            }
            throw r;
        }
    }
    _request(t, n) {
        typeof t == "string" ? ((n = n || {}), (n.url = t)) : (n = t || {}),
            (n = I(this.defaults, n));
        const { transitional: r, paramsSerializer: s, headers: i } = n;
        r !== void 0 &&
            te.assertOptions(
                r,
                {
                    silentJSONParsing: F.transitional(F.boolean),
                    forcedJSONParsing: F.transitional(F.boolean),
                    clarifyTimeoutError: F.transitional(F.boolean),
                },
                !1
            ),
            s != null &&
                (a.isFunction(s)
                    ? (n.paramsSerializer = { serialize: s })
                    : te.assertOptions(
                          s,
                          { encode: F.function, serialize: F.function },
                          !0
                      )),
            n.allowAbsoluteUrls !== void 0 ||
                (this.defaults.allowAbsoluteUrls !== void 0
                    ? (n.allowAbsoluteUrls = this.defaults.allowAbsoluteUrls)
                    : (n.allowAbsoluteUrls = !0)),
            te.assertOptions(
                n,
                {
                    baseUrl: F.spelling("baseURL"),
                    withXsrfToken: F.spelling("withXSRFToken"),
                },
                !0
            ),
            (n.method = (
                n.method ||
                this.defaults.method ||
                "get"
            ).toLowerCase());
        let o = i && a.merge(i.common, i[n.method]);
        i &&
            a.forEach(
                ["delete", "get", "head", "post", "put", "patch", "common"],
                (u) => {
                    delete i[u];
                }
            ),
            (n.headers = N.concat(o, i));
        const c = [];
        let p = !0;
        this.interceptors.request.forEach(function (h) {
            (typeof h.runWhen == "function" && h.runWhen(n) === !1) ||
                ((p = p && h.synchronous), c.unshift(h.fulfilled, h.rejected));
        });
        const f = [];
        this.interceptors.response.forEach(function (h) {
            f.push(h.fulfilled, h.rejected);
        });
        let l,
            m = 0,
            b;
        if (!p) {
            const u = [Me.bind(this), void 0];
            for (
                u.unshift(...c),
                    u.push(...f),
                    b = u.length,
                    l = Promise.resolve(n);
                m < b;

            )
                l = l.then(u[m++], u[m++]);
            return l;
        }
        b = c.length;
        let w = n;
        for (; m < b; ) {
            const u = c[m++],
                h = c[m++];
            try {
                w = u(w);
            } catch (d) {
                h.call(this, d);
                break;
            }
        }
        try {
            l = Me.call(this, w);
        } catch (u) {
            return Promise.reject(u);
        }
        for (m = 0, b = f.length; m < b; ) l = l.then(f[m++], f[m++]);
        return l;
    }
    getUri(t) {
        t = I(this.defaults, t);
        const n = it(t.baseURL, t.url, t.allowAbsoluteUrls);
        return tt(n, t.params, t.paramsSerializer);
    }
};
a.forEach(["delete", "get", "head", "options"], function (t) {
    q.prototype[t] = function (n, r) {
        return this.request(
            I(r || {}, { method: t, url: n, data: (r || {}).data })
        );
    };
});
a.forEach(["post", "put", "patch"], function (t) {
    function n(r) {
        return function (i, o, c) {
            return this.request(
                I(c || {}, {
                    method: t,
                    headers: r ? { "Content-Type": "multipart/form-data" } : {},
                    url: i,
                    data: o,
                })
            );
        };
    }
    (q.prototype[t] = n()), (q.prototype[t + "Form"] = n(!0));
});
let Hn = class ft {
    constructor(t) {
        if (typeof t != "function")
            throw new TypeError("executor must be a function.");
        let n;
        this.promise = new Promise(function (i) {
            n = i;
        });
        const r = this;
        this.promise.then((s) => {
            if (!r._listeners) return;
            let i = r._listeners.length;
            for (; i-- > 0; ) r._listeners[i](s);
            r._listeners = null;
        }),
            (this.promise.then = (s) => {
                let i;
                const o = new Promise((c) => {
                    r.subscribe(c), (i = c);
                }).then(s);
                return (
                    (o.cancel = function () {
                        r.unsubscribe(i);
                    }),
                    o
                );
            }),
            t(function (i, o, c) {
                r.reason || ((r.reason = new $(i, o, c)), n(r.reason));
            });
    }
    throwIfRequested() {
        if (this.reason) throw this.reason;
    }
    subscribe(t) {
        if (this.reason) {
            t(this.reason);
            return;
        }
        this._listeners ? this._listeners.push(t) : (this._listeners = [t]);
    }
    unsubscribe(t) {
        if (!this._listeners) return;
        const n = this._listeners.indexOf(t);
        n !== -1 && this._listeners.splice(n, 1);
    }
    toAbortSignal() {
        const t = new AbortController(),
            n = (r) => {
                t.abort(r);
            };
        return (
            this.subscribe(n),
            (t.signal.unsubscribe = () => this.unsubscribe(n)),
            t.signal
        );
    }
    static source() {
        let t;
        return {
            token: new ft(function (s) {
                t = s;
            }),
            cancel: t,
        };
    }
};
function Mn(e) {
    return function (n) {
        return e.apply(null, n);
    };
}
function $n(e) {
    return a.isObject(e) && e.isAxiosError === !0;
}
const be = {
    Continue: 100,
    SwitchingProtocols: 101,
    Processing: 102,
    EarlyHints: 103,
    Ok: 200,
    Created: 201,
    Accepted: 202,
    NonAuthoritativeInformation: 203,
    NoContent: 204,
    ResetContent: 205,
    PartialContent: 206,
    MultiStatus: 207,
    AlreadyReported: 208,
    ImUsed: 226,
    MultipleChoices: 300,
    MovedPermanently: 301,
    Found: 302,
    SeeOther: 303,
    NotModified: 304,
    UseProxy: 305,
    Unused: 306,
    TemporaryRedirect: 307,
    PermanentRedirect: 308,
    BadRequest: 400,
    Unauthorized: 401,
    PaymentRequired: 402,
    Forbidden: 403,
    NotFound: 404,
    MethodNotAllowed: 405,
    NotAcceptable: 406,
    ProxyAuthenticationRequired: 407,
    RequestTimeout: 408,
    Conflict: 409,
    Gone: 410,
    LengthRequired: 411,
    PreconditionFailed: 412,
    PayloadTooLarge: 413,
    UriTooLong: 414,
    UnsupportedMediaType: 415,
    RangeNotSatisfiable: 416,
    ExpectationFailed: 417,
    ImATeapot: 418,
    MisdirectedRequest: 421,
    UnprocessableEntity: 422,
    Locked: 423,
    FailedDependency: 424,
    TooEarly: 425,
    UpgradeRequired: 426,
    PreconditionRequired: 428,
    TooManyRequests: 429,
    RequestHeaderFieldsTooLarge: 431,
    UnavailableForLegalReasons: 451,
    InternalServerError: 500,
    NotImplemented: 501,
    BadGateway: 502,
    ServiceUnavailable: 503,
    GatewayTimeout: 504,
    HttpVersionNotSupported: 505,
    VariantAlsoNegotiates: 506,
    InsufficientStorage: 507,
    LoopDetected: 508,
    NotExtended: 510,
    NetworkAuthenticationRequired: 511,
};
Object.entries(be).forEach(([e, t]) => {
    be[t] = e;
});
function dt(e) {
    const t = new q(e),
        n = ze(q.prototype.request, t);
    return (
        a.extend(n, q.prototype, t, { allOwnKeys: !0 }),
        a.extend(n, t, null, { allOwnKeys: !0 }),
        (n.create = function (s) {
            return dt(I(e, s));
        }),
        n
    );
}
const S = dt(K);
S.Axios = q;
S.CanceledError = $;
S.CancelToken = Hn;
S.isCancel = st;
S.VERSION = ut;
S.toFormData = ie;
S.AxiosError = y;
S.Cancel = S.CanceledError;
S.all = function (t) {
    return Promise.all(t);
};
S.spread = Mn;
S.isAxiosError = $n;
S.mergeConfig = I;
S.AxiosHeaders = N;
S.formToJSON = (e) => rt(a.isHTMLForm(e) ? new FormData(e) : e);
S.getAdapter = lt.getAdapter;
S.HttpStatusCode = be;
S.default = S;
const {
    Axios: Jn,
    AxiosError: Vn,
    CanceledError: Wn,
    isCancel: Kn,
    CancelToken: Xn,
    VERSION: Gn,
    all: Qn,
    Cancel: Zn,
    isAxiosError: Yn,
    spread: er,
    toFormData: tr,
    AxiosHeaders: nr,
    HttpStatusCode: rr,
    formToJSON: sr,
    getAdapter: or,
    mergeConfig: ir,
} = S;
window.axios = S;
window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
document.addEventListener("DOMContentLoaded", function () {
    var p;
    (p = document.querySelector('meta[name="csrf-token"]')) == null ||
        p.getAttribute("content");
    function e(f) {
        const l = document.getElementById("cart-count-desktop"),
            m = document.getElementById("cart-count-mobile");
        [l, m].forEach((w) => {
            w &&
                ((w.textContent = f),
                f > 0
                    ? w.classList.remove("hidden")
                    : w.classList.add("hidden"));
        });
    }
    let t;
    function n(f) {
        const l = document.getElementById("notification-banner");
        l &&
            ((l.textContent = f),
            l.classList.remove("hidden"),
            clearTimeout(t),
            (t = setTimeout(() => {
                l.classList.add("hidden");
            }, 3e3)));
    }
    if (document.querySelector(".category-btn")) {
        document.querySelectorAll(".add-to-cart-btn").forEach((w) => {
            w.addEventListener("click", function () {
                const u = this.dataset.productId,
                    h = this.dataset.productName,
                    d = document.getElementById("quantity-" + u),
                    E = parseInt(d.value, 10);
                E > 0 &&
                    axios
                        .post("/cart/add", { product_id: u, quantity: E })
                        .then((g) => {
                            g.data.success &&
                                (e(g.data.cart_count),
                                n(
                                    `Anda telah memesan ${h} dengan jumlah ${E}`
                                ));
                        })
                        .catch((g) => {
                            console.error("Error adding to cart:", g),
                                alert("Gagal menambahkan item.");
                        });
            });
        });
        const l = document.querySelectorAll(".category-btn"),
            m = document.querySelectorAll(".product-card"),
            b = document.querySelectorAll(".category-group");
        l.forEach((w) => {
            w.addEventListener("click", function () {
                l.forEach((h) =>
                    h.classList.remove("active", "bg-red-600", "text-white")
                ),
                    this.classList.add("active", "bg-red-600", "text-white");
                const u = this.dataset.category;
                if (u === "all")
                    m.forEach((h) => (h.style.display = "flex")),
                        b.forEach((h) => (h.style.display = "block"));
                else {
                    b.forEach((d) => (d.style.display = "none"));
                    const h = document.getElementById("category-" + u);
                    h && (h.style.display = "block");
                }
            });
        });
    }
    const s = document.getElementById("cart-items-wrapper");
    s &&
        s.addEventListener("click", function (f) {
            const l = f.target;
            function m(b, w) {
                b.then((u) => {
                    var h, d;
                    if (u.data.success) {
                        if ((e(u.data.cart_count), u.data.cart_count === 0)) {
                            document.getElementById(
                                "cart-container"
                            ).innerHTML =
                                '<p class="text-center text-gray-500">Keranjang Anda kosong.</p>';
                            return;
                        }
                        const E = document.getElementById("cart-total");
                        E &&
                            (E.innerText =
                                "Rp " +
                                new Intl.NumberFormat("id-ID").format(
                                    u.data.cart_total
                                ));
                        const g =
                            (d =
                                (h = u.data.cart_items) == null
                                    ? void 0
                                    : h[w]) == null
                                ? void 0
                                : d.quantity;
                        document.querySelectorAll("#row-" + w).forEach((O) => {
                            if (!g) O.remove();
                            else {
                                const A = O.querySelector(".quantity-span"),
                                    P = O.querySelector(".subtotal"),
                                    x = u.data.cart_items[w].price;
                                A && (A.textContent = g),
                                    P &&
                                        (P.textContent =
                                            "Rp " +
                                            new Intl.NumberFormat(
                                                "id-ID"
                                            ).format(g * x));
                            }
                        });
                    }
                }).catch((u) => {
                    console.error("Error updating cart:", u),
                        alert("Gagal memperbarui keranjang.");
                });
            }
            if (l.classList.contains("remove-item-btn")) {
                const b = l.dataset.productId;
                m(axios.post("/cart/remove", { product_id: b }), b);
            }
            if (l.classList.contains("quantity-btn")) {
                const b = l.dataset.productId,
                    w = parseInt(l.dataset.change, 10),
                    u = l.closest("#row-" + b).querySelector(".quantity-span"),
                    d = parseInt(u.textContent, 10) + w;
                d > 0
                    ? m(
                          axios.post("/cart/update", {
                              product_id: b,
                              quantity: d,
                          }),
                          b
                      )
                    : m(axios.post("/cart/remove", { product_id: b }), b);
            }
        });
    const i = document.getElementById("mobile-menu-button"),
        o = document.getElementById("mobile-sidebar"),
        c = document.getElementById("sidebar-content");
    i &&
        (i.addEventListener("click", function () {
            o.classList.remove("hidden"),
                setTimeout(() => {
                    c.classList.remove("-translate-x-full");
                }, 10);
        }),
        o.addEventListener("click", function (f) {
            f.target === o &&
                (c.classList.add("-translate-x-full"),
                setTimeout(() => {
                    o.classList.add("hidden");
                }, 300));
        }));
});
