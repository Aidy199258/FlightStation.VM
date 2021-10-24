//Functions to calculate the distance between two airports using coordinates
// and to estimate hrs needed for the flight
function getDistance(lat1, lat2, lon1, lon2) {
    const Lat1 = lat1 * Math.PI/180, Lat2 = lat2 * Math.PI/180, dif = (lon2-lon1) * Math.PI/180, R = 6371e3;
    const d = Math.acos( Math.sin(Lat1)*Math.sin(Lat2) + Math.cos(Lat1)*Math.cos(Lat2) * Math.cos(dif) ) * R;
    return d;
}
