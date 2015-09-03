function unique(ary) {
    var i = 0,
        gid='_'+(+new Date)+Math.random(),
        objs = [],
        hash = {
            'string': {},
            'boolean': {},
            'number': {}
        }, p, l = ary.length,
        ret = [];
    for (; i < l; i++) {
        p = ary[i];
        if (p == null) continue;
        var tp = typeof p;
        if (tp in hash) {
            if (!(p in hash[tp])) {
                hash[tp][p] = 1;
                ret.push(p);
            }
        } else {
            if (p[gid]) continue;
            p[gid]=1;
            objs.push(p);
            ret.push(p);
        }
    }
    for(i=0,l=objs.length;i<l;i++) {
        p=objs[i];
        p[gid]=undefined;
        delete p[gid];
    }
    return ret;
}

function process(){
    var list = document.getElementById('list');
    var arr = list.value.split('\n');
    var oldNum = arr.length;
    arr = unique(arr);
    var newNum = arr.length;
    list.value = "";
    for(var key in arr){
	    list.value += arr[key] + '\n';
    }
    alert("处理完成！"+oldNum+":old=>new:"+newNum);
} 