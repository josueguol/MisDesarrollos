export default function NavigationMenu(){
    const url = "http://localhost:5000/navigation";
    
    function toJson(response){
        return response.json();
    }
    
    async function get() {
        const response = await fetch(url);
        return toJson(response);
    }
    
    return  Object.freeze({
        get
    });
}