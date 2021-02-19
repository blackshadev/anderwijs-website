interface IRawEvent {
    name: string;
    code: string;
    description: string;
    dates: {
        preparation: string;
        start: string;
        end: string;
    };
    location: {
        name: string;
        address: string;
        zipcode: string;
        city: string
        website: string;
        phone: string;
    };
    pricing: {
        type: 'NONE'|'UNKNOWN'|'KNOWN';
        fullPrice: number|null;
        discounts: {
            [percentage: string]: number;
        }
    };
}


interface IEvent {
    name: string;
    code: string;
    description: string;
    dates: {
        preparation: Date;
        start: Date;
        end: Date;
    };
    location: {
        name: string;
        address: string;
        zipcode: string;
        city: string
        website: string;
        phone: string;
    };
    pricing: {
        type: 'NONE'|'UNKNOWN'|'KNOWN';
        fullPrice: number|null;
        discounts: {
            [percentage: string]: number;
        }
    };
}