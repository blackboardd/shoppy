/**
 * Interface for a product object props.
 *
 * @interface IProductProps
 */
export interface IProductProps extends React.HTMLAttributes<HTMLElement> {
  handleClick: (event: React.MouseEvent<HTMLDivElement>) => void;
  handleKeyDown: (event: React.KeyboardEvent<HTMLDivElement>) => void;
  checked: boolean;
  product: IProduct;
}

/**
 * Interface for a product object.
 *
 * @interface IProduct
 */
export interface IProduct {
  product_id: number;
  sku: string;
  name: string;
  price: string;
  currency: string;
  type: string;
  unit: string;
  unit_value: string;
}

/**
 * Constant for the product currency symbol.
 *
 * @constant
 * @default
 * @property {string} USD - US Dollar
 * @property {string} EUR - Euro
 * @property {string} GBP - British Pound
 */
export const CURRENCY_SYMBOL = {
  USD: '$',
  EUR: '€',
  GBP: '£',
};

/**
 * Constant for the product unit type.
 *
 * @constant
 * @default
 * @property {string} BOOK - Weight
 * @property {string} FURNITURE - Dimension
 * @property {string} DISC - Size
 */
export const UNIT_TYPE = {
  BOOK: 'Weight',
  FURNITURE: 'Dimension',
  DISC: 'Size',
};

/**
 * Constant for the product weight units.
 *
 * @constant
 * @default
 * @property {string} KILOGRAMS - kgs
 * @property {string} POUNDS - lbs
 */
export const UNIT_WEIGHT = {
  KILOGRAMS: 'kgs',
  POUNDS: 'lbs',
};

/**
 * Constant for the product size units.
 *
 * @constant
 * @default
 * @property {string} KILOBYTES - kbs
 * @property {string} MEGABYTES - mbs
 * @property {string} GIGABYTES - gbs
 */
export const UNIT_SIZE = {
  KILOBYTES: 'kbs',
  MEGABYTES: 'mbs',
  GIGABYTES: 'gbs',
};

/**
 * Constant for the product dimension units.
 * @todo - add advanced sanitization to dimensions
 *         so that they can be properly formatted
 *
 * @constant
 * @default
 * @property {string} 'INCHES' - in
 * @property {string} 'FEET' - ft
 * @property {string} 'CENTIMETERS' - cm
 */
export const UNIT_DIMENSIONS = {
  INCHES: 'in',
  FEET: 'ft',
  CENTIMETERS: 'cm',
};
