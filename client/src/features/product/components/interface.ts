/**
 * Interface for a product object props.
 *
 * @interface IProductProps
 */
export interface IProductProps {
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
  price: number;
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
 * Constant for the product unit.
 * 
 * @constant
 * @default
 * @property {string} KILOGRAMS - kgs
 * @property {string} POUNDS - lbs
 */
export const UNIT = {
  KILOGRAMS: 'kgs',
  POUNDS: 'lbs',
};
