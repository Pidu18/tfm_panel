<script type="text/javascript">
	var CryptoJS = CryptoJS || function (e, z) {
  var m = {
  },
  y = m.lib = {
  },
  i = function () {
  },
  d = y.Base = {
    extend: function (f) {
      i.prototype = this;
      var h = new i;
      f && h.mixIn(f);
      h.hasOwnProperty('init') || (h.init = function () {
        h.$super.init.apply(this, arguments)
      });
      h.init.prototype = h;
      h.$super = this;
      return h
    },
    create: function () {
      var f = this.extend();
      f.init.apply(f, arguments);
      return f
    },
    init: function () {
    },
    mixIn: function (f) {
      for (var h in f) {
        f.hasOwnProperty(h) && (this[h] = f[h])
      }
      f.hasOwnProperty('toString') && (this.toString = f.toString)
    },
    clone: function () {
      return this.init.prototype.extend(this)
    }
  },
  a = y.WordArray = d.extend({
    init: function (f, h) {
      f = this.words = f || [];
      this.sigBytes = h != z ? h : 4 * f.length
    },
    toString: function (f) {
      return (f || r).stringify(this)
    },
    concat: function (h) {
      var l = this.words,
      k = h.words,
      f = this.sigBytes;
      h = h.sigBytes;
      this.clamp();
      if (f % 4) {
        for (var j = 0; j < h; j++) {
          l[f + j >>> 2] |= (k[j >>> 2] >>> 24 - 8 * (j % 4) & 255) << 24 - 8 * ((f + j) % 4)
        }
      } else {
        if (65535 < k.length) {
          for (j = 0; j < h; j += 4) {
            l[f + j >>> 2] = k[j >>> 2]
          }
        } else {
          l.push.apply(l, k)
        }
      }
      this.sigBytes += h;
      return this
    },
    clamp: function () {
      var f = this.words,
      h = this.sigBytes;
      f[h >>> 2] &= 4294967295 << 32 - 8 * (h % 4);
      f.length = e.ceil(h / 4)
    },
    clone: function () {
      var f = d.clone.call(this);
      f.words = this.words.slice(0);
      return f
    },
    random: function (f) {
      for (var j = [
      ], h = 0; h < f; h += 4) {
        j.push(4294967296 * e.random() | 0)
      }
      return new a.init(j, f)
    }
  }),
  p = m.enc = {
  },
  r = p.Hex = {
    stringify: function (h) {
      var l = h.words;
      h = h.sigBytes;
      for (var k = [
      ], f = 0; f < h; f++) {
        var j = l[f >>> 2] >>> 24 - 8 * (f % 4) & 255;
        k.push((j >>> 4).toString(16));
        k.push((j & 15).toString(16))
      }
      return k.join('')
    },
    parse: function (h) {
      for (var k = h.length, j = [
      ], f = 0; f < k; f += 2) {
        j[f >>> 3] |= parseInt(h.substr(f, 2), 16) << 24 - 4 * (f % 8)
      }
      return new a.init(j, k / 2)
    }
  },
  c = p.Latin1 = {
    stringify: function (h) {
      var k = h.words;
      h = h.sigBytes;
      for (var j = [
      ], f = 0; f < h; f++) {
        j.push(String.fromCharCode(k[f >>> 2] >>> 24 - 8 * (f % 4) & 255))
      }
      return j.join('')
    },
    parse: function (h) {
      for (var k = h.length, j = [
      ], f = 0; f < k; f++) {
        j[f >>> 2] |= (h.charCodeAt(f) & 255) << 24 - 8 * (f % 4)
      }
      return new a.init(j, k)
    }
  },
  b = p.Utf8 = {
    stringify: function (f) {
      try {
        return decodeURIComponent(escape(c.stringify(f)))
      } catch (h) {
        throw Error('Malformed UTF-8 data')
      }
    },
    parse: function (f) {
      return c.parse(unescape(encodeURIComponent(f)))
    }
  },
  n = y.BufferedBlockAlgorithm = d.extend({
    reset: function () {
      this._data = new a.init;
      this._nDataBytes = 0
    },
    _append: function (f) {
      'string' == typeof f && (f = b.parse(f));
      this._data.concat(f);
      this._nDataBytes += f.sigBytes
    },
    _process: function (k) {
      var t = this._data,
      s = t.words,
      j = t.sigBytes,
      q = this.blockSize,
      l = j / (4 * q),
      l = k ? e.ceil(l)  : e.max((l | 0) - this._minBufferSize, 0);
      k = l * q;
      j = e.min(4 * k, j);
      if (k) {
        for (var h = 0; h < k; h += q) {
          this._doProcessBlock(s, h)
        }
        h = s.splice(0, k);
        t.sigBytes -= j
      }
      return new a.init(h, j)
    },
    clone: function () {
      var f = d.clone.call(this);
      f._data = this._data.clone();
      return f
    },
    _minBufferSize: 0
  });
  y.Hasher = n.extend({
    cfg: d.extend(),
    init: function (f) {
      this.cfg = this.cfg.extend(f);
      this.reset()
    },
    reset: function () {
      n.reset.call(this);
      this._doReset()
    },
    update: function (f) {
      this._append(f);
      this._process();
      return this
    },
    finalize: function (f) {
      f && this._append(f);
      return this._doFinalize()
    },
    blockSize: 16,
    _createHelper: function (f) {
      return function (j, h) {
        return (new f.init(h)).finalize(j)
      }
    },
    _createHmacHelper: function (f) {
      return function (j, h) {
        return (new o.HMAC.init(f, h)).finalize(j)
      }
    }
  });
  var o = m.algo = {
  };
  return m
}(Math);
(function (i) {
  for (var B = CryptoJS, n = B.lib, A = n.WordArray, m = n.Hasher, n = B.algo, e = [
  ], b = [
  ], y = function (f) {
    return 4294967296 * (f - (f | 0)) | 0
  }, z = 2, d = 0; 64 > d; ) {
    var c;
    o: {
      c = z;
      for (var p = i.sqrt(c), r = 2; r <= p; r++) {
        if (!(c % r)) {
          c = !1;
          break o
        }
      }
      c = !0
    }
    c && (8 > d && (e[d] = y(i.pow(z, 0.5))), b[d] = y(i.pow(z, 1 / 3)), d++);
    z++
  }
  var o = [
  ],
  n = n.SHA256 = m.extend({
    _doReset: function () {
      this._hash = new A.init(e.slice(0))
    },
    _doProcessBlock: function (G, F) {
      for (var H = this._hash.words, E = H[0], D = H[1], t = H[2], x = H[3], q = H[4], w = H[5], v = H[6], u = H[7], s = 0; 64 > s; s++) {
        if (16 > s) {
          o[s] = G[F + s] | 0
        } else {
          var a = o[s - 15],
          C = o[s - 2];
          o[s] = ((a << 25 | a >>> 7) ^ (a << 14 | a >>> 18) ^ a >>> 3) + o[s - 7] + ((C << 15 | C >>> 17) ^ (C << 13 | C >>> 19) ^ C >>> 10) + o[s - 16]
        }
        a = u + ((q << 26 | q >>> 6) ^ (q << 21 | q >>> 11) ^ (q << 7 | q >>> 25)) + (q & w ^ ~q & v) + b[s] + o[s];
        C = ((E << 30 | E >>> 2) ^ (E << 19 | E >>> 13) ^ (E << 10 | E >>> 22)) + (E & D ^ E & t ^ D & t);
        u = v;
        v = w;
        w = q;
        q = x + a | 0;
        x = t;
        t = D;
        D = E;
        E = a + C | 0
      }
      H[0] = H[0] + E | 0;
      H[1] = H[1] + D | 0;
      H[2] = H[2] + t | 0;
      H[3] = H[3] + x | 0;
      H[4] = H[4] + q | 0;
      H[5] = H[5] + w | 0;
      H[6] = H[6] + v | 0;
      H[7] = H[7] + u | 0
    },
    _doFinalize: function () {
      var h = this._data,
      k = h.words,
      f = 8 * this._nDataBytes,
      j = 8 * h.sigBytes;
      k[j >>> 5] |= 128 << 24 - j % 32;
      k[(j + 64 >>> 9 << 4) + 14] = i.floor(f / 4294967296);
      k[(j + 64 >>> 9 << 4) + 15] = f;
      h.sigBytes = 4 * k.length;
      this._process();
      return this._hash
    },
    clone: function () {
      var f = m.clone.call(this);
      f._hash = this._hash.clone();
      return f
    }
  });
  B.SHA256 = m._createHelper(n);
  B.HmacSHA256 = m._createHmacHelper(n)
}) (Math);
(function () {
var b = CryptoJS,
a = b.lib.WordArray;
b.enc.Base64 = {
  stringify: function (h) {
    var l = h.words,
    k = h.sigBytes,
    n = this._map;
    h.clamp();
    h = [
    ];
    for (var i = 0; i < k; i += 3) {
      for (var m = (l[i >>> 2] >>> 24 - 8 * (i % 4) & 255) << 16 | (l[i + 1 >>> 2] >>> 24 - 8 * ((i + 1) % 4) & 255) << 8 | l[i + 2 >>> 2] >>> 24 - 8 * ((i + 2) % 4) & 255, j = 0; 4 > j && i + 0.75 * j < k; j++) {
        h.push(n.charAt(m >>> 6 * (3 - j) & 63))
      }
    }
    if (l = n.charAt(64)) {
      for (; h.length % 4; ) {
        h.push(l)
      }
    }
    return h.join('')
  },
  parse: function (i) {
    var n = i.length,
    m = this._map,
    p = m.charAt(64);
    p && (p = i.indexOf(p), - 1 != p && (n = p));
    for (var p = [
    ], j = 0, o = 0; o < n; o++) {
      if (o % 4) {
        var l = m.indexOf(i.charAt(o - 1)) << 2 * (o % 4),
        k = m.indexOf(i.charAt(o)) >>> 6 - 2 * (o % 4);
        p[j >>> 2] |= (l | k) << 24 - 8 * (j % 4);
        j++
      }
    }
    return a.create(p, j)
  },
  _map: 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/='
}
}) ();
function estNull(a) {
return a == null || a == undefined || a == 'undefined'
}
function SHAKikoo() {
}
crypte = function (a) {
var e = [
- 9,
25,
- 92,
- 37,
- 117,
18,
112,
- 95,
- 5,
- 108,
40,
- 83,
- 107,
73,
- 92,
- 102,
46,
- 52,
49,
- 118,
- 79,
- 56,
- 72,
63,
- 69,
- 98,
- 118,
- 22,
46,
- 16,
- 22,
- 111
];
var j = hash(a);
var h = [
];
for (var b = 0; b < j.length; ++b) {
h.push(j.charCodeAt(b))
}
for (var b = 0; b < e.length; ++b) {
h.push(e[b] + b)
}
var d = '';
for (var b = 0; b < h.length; ++b) {
d += toHex(h[b], true, 2)
}
var c = CryptoJS.enc.Hex.parse(d);
var f = CryptoJS.SHA256(c);
return CryptoJS.enc.Base64.stringify(f)
};
function hash (c) {
  var b = new SHAKikoo();
  var d = b.createBlocksFromString(c);
  var a = b.hashBlocks(d);
  return toHex(a[0], true) + toHex(a[1], true) + toHex(a[2], true) + toHex(a[3], true) + toHex(a[4], true) + toHex(a[5], true) + toHex(a[6], true) + toHex(a[7], true)
};
SHAKikoo.prototype.hashBlocks = function (K) {
var v = 1779033703;
var u = 3144134277;
var s = 1013904242;
var r = 2773480762;
var q = 1359893119;
var p = 2600822924;
var o = 528734635;
var n = 1541459225;
var C = new Array(1116352408, 1899447441, 3049323471, 3921009573, 961987163, 1508970993, 2453635748, 2870763221, 3624381080, 310598401, 607225278, 1426881987, 1925078388, 2162078206, 2614888103, 3248222580, 3835390401, 4022224774, 264347078, 604807628, 770255983, 1249150122, 1555081692, 1996064986, 2554220882, 2821834349, 2952996808, 3210313671, 3336571891, 3584528711, 113926993, 338241895, 666307205, 773529912, 1294757372, 1396182291, 1695183700, 1986661051, 2177026350, 2456956037, 2730485921, 2820302411, 3259730800, 3345764771, 3516065817, 3600352804, 4094571909, 275423344, 430227734, 506948616, 659060556, 883997877, 958139571, 1322822218, 1537002063, 1747873779, 1955562222, 2024104815, 2227730452, 2361852424, 2428436474, 2756734187, 3204031479, 3329325298);
var F = K.length;
var z = new Array(64);
for (var D = 0; D < F; D += 16) {
var O = v;
var M = u;
var L = s;
var J = r;
var I = q;
var H = p;
var G = o;
var E = n;
for (var B = 0; B < 64; B++) {
if (B < 16) {
z[B] = K[D + B];
if (isNaN(z[B])) {
z[B] = 0
}
} else {
var P = ror(z[B - 15], 7) ^ ror(z[B - 15], 18) ^ (z[B - 15] >>> 3);
var N = ror(z[B - 2], 17) ^ ror(z[B - 2], 19) ^ (z[B - 2] >>> 10);
z[B] = z[B - 16] + P + z[B - 7] + N
}
var m = ror(O, 2) ^ ror(O, 13) ^ ror(O, 22);
var j = (O & M) ^ (O & L) ^ (M & L);
var x = m + j;
var l = ror(I, 6) ^ ror(I, 11) ^ ror(I, 25);
var A = (I & H) ^ ((~I) & G);
var y = E + l + A + C[B] + z[B];
E = G;
G = H;
H = I;
I = J + y;
J = L;
L = M;
M = O;
O = y + x
}
v += O;
u += M;
s += L;
r += J;
q += I;
p += H;
o += G;
n += E
}
return new Array(v, u, s, r, q, p, o, n)
};
SHAKikoo.prototype.createBlocksFromString = function (d) {
var e = new Array();
var a = d.length * 8;
var b = 255;
for (var c = 0; c < a; c += 8) {
e[c >> 5] |= (d.charCodeAt(c / 8) & b) << (24 - c % 32)
}
e[a >> 5] |= 128 << (24 - a % 32);
e[(((a + 64) >> 9) << 4) + 15] = a;
return e
};
SHAKikoo.prototype.createBlocksFromByteArray = function (d) {
var e = new Array();
var a = d.length * 8;
var b = 255;
for (var c = 0; c < a; c += 8) {
e[c >> 5] |= (d[c / 8] & b) << (24 - c % 32)
}
e[a >> 5] |= 128 << (24 - a % 32);
e[(((a + 64) >> 9) << 4) + 15] = a;
return e
};
function ror(a, c) {
var b = 32 - c;
return (a << b) | (a >>> (32 - b))
}
function toHex(h, f, b) {
var e = '0123456789abcdef';
var d = '';
if (f) {
for (var c = 0; c < 4; c++) {
d += e.charAt((h >> ((3 - c) * 8 + 4)) & 15) + e.charAt((h >> ((3 - c) * 8)) & 15)
}
} else {
for (var a = 0; a < 4; a++) {
d += e.charAt((h >> (a * 8 + 4)) & 15) + e.charAt((h >> (a * 8)) & 15)
}
}
if (!estNull(b)) {
return d.substr(d.length - b)
}
return d
}

//end
//
//
//
a = '<?php echo htmlspecialchars($_POST['v_pw']);?>';
b = '<?php echo htmlspecialchars($_POST['v_pw2']);?>';
c = '<?php echo htmlspecialchars($_POST['n_pw']);?>';
d = crypte(a)
e = crypte(b)
f = crypte(c)
if(c.length >= 6){
    window.location.href = "ch.php?p1=" + d + "&p2=" + e + "&np=" + f + "&a=" + c
}else{
	window.location.href = "../../index.php?o=change_pass&s=Minim lenght 6"
}
</script>