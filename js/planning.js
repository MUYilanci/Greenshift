function plan(element, date){
    const nextmonday = dateNextMonday();
    console.log(nextmonday)
    new Promise((resolve, reject) => {
        setTimeout(() => {
            element.style.backgroundColor = 'red';
            resolve()
        }, 200)
    });
}

function dateNextMonday(){
    const dayofweek = new Date().getDay();

    const daytillmonday = 7 - dayofweek + 1;
    const datemonday = new Date().setDate(new Date().getDate() + daytillmonday);
    return Date(datemonday);
}