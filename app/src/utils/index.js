export const getDistance = (geo1, geo2) => {
    if(geo1 && geo2) {
        const R = 6371e3; // metres
        const φ1 = geo1.coords.latitude * Math.PI / 180; // φ, λ in radians
        const φ2 = geo2.coords.latitude * Math.PI / 180;
        const Δφ = (geo2.coords.latitude - geo1.coords.latitude) * Math.PI / 180;
        const Δλ = (geo2.coords.longitude - geo1.coords.longitude) * Math.PI / 180;
        
        const a = Math.sin(Δφ / 2) * Math.sin(Δφ / 2) +
            Math.cos(φ1) * Math.cos(φ2) *
            Math.sin(Δλ / 2) * Math.sin(Δλ / 2);
        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        
        const d = R * c; // in metres
        return d;
    }

    return 0;
}
