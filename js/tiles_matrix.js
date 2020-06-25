var init_rows = 7

var map = create2darray(init_rows);
map [0][0] = 0;
map [0][1] = 0;
map [0][2] = 0;
map [0][3] = 0;
map [0][4] = 0;
map [0][5] = 0;
map [0][6] = 0;
map [1][0] = 0;
map [1][1] = 1;
map [1][2] = 1;
map [1][3] = 0;
map [1][4] = 2;
map [1][5] = 0;
map [1][6] = 0;
map [2][0] = 0;
map [2][1] = 0;
map [2][2] = 0;
map [2][3] = 1;
map [2][4] = 0;
map [2][5] = 0;
map [2][6] = 0;
map [3][0] = 0;
map [3][1] = 0;
map [3][2] = 0;
map [3][3] = 0;
map [3][4] = 0;
map [3][5] = 0;
map [3][6] = 1;
map [4][0] = 0;
map [4][1] = 0;
map [4][2] = 0;
map [4][3] = 1;
map [4][4] = 0;
map [4][5] = 1;
map [4][6] = 0;
map [5][0] = 0;
map [5][1] = 0;
map [5][2] = 0;
map [5][3] = 0;
map [5][4] = 0;
map [5][5] = 1;
map [5][6] = 1;
map [6][0] = 0;
map [6][1] = 2;
map [6][2] = 0;
map [6][3] = 0;
map [6][4] = 0;
map [6][5] = 1;
map [6][6] = 1;

function create2darray(rows) {
    var arr = [];
    for (var i=0;i<rows;i++){
        arr[i] = [];
    }
    return arr;
}