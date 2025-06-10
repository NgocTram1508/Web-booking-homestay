const images=document.querySelector('.images')
const img=document.querySelectorAll('.images img')
const btnl=document.querySelector('.btnL')
const btnR=document.querySelector('.btnR')
let i=0

const handlechangesile=()=>{
    if(i==img.length-1)
        {
            i=0;
            let wiith=img[0].offsetWidth
            //console.log(wiith)
            images.style.transform=`translateX(0px)`
            document.querySelector('.active').classList.remove('active')
            document.querySelector('.index-item-'+i).classList.add('active')
        }
        else{
            i++
            let wiith=img[0].offsetWidth
            //console.log(wiith)
            images.style.transform=`translateX(${wiith*-1*i}px)`
            document.querySelector('.active').classList.remove('active')
            document.querySelector('.index-item-'+i).classList.add('active')
        }
}

let handlevenchange=setInterval(handlechangesile,4000)

btnR.addEventListener('click',()=>{
    clearInterval(handlevenchange)
    handlechangesile()
    handlevenchange=setInterval(handlechangesile,4000)
})

btnl.addEventListener('click',()=>{
    clearInterval(handlevenchange)
    if(i==0)
        {
            i=image.length-1;
            let wiith=img[0].offsetWidth
            //console.log(wiith)
            images.style.transform=`translateX(${wiith*-1*i}px)`
            document.querySelector('.active').classList.remove('active')
            document.querySelector('.index-item-'+i).classList.add('active')
        }
        else{
            i--
            let wiith=img[0].offsetWidth
            //console.log(wiith)
            images.style.transform=`translateX(${wiith*-1*i}px)`
            document.querySelector('.active').classList.remove('active')
            document.querySelector('.index-item-'+i).classList.add('active')
        }
        handlevenchange=setInterval(handlechangesile,4000)
})