import {
  CURRENCY_SYMBOL,
  IProduct,
} from '@/features/product/components/interface';
import { Currency } from '../components/types';

/**
 * Provider for product.
 *
 * @class ProductProvider
 */
export class ProductProvider {
  /**
   * Get all products.
   *
   * @returns {Promise<IProduct[]>}
   * @memberof ProductProvider
   * @static
   */
  public static async getProducts(): Promise<IProduct[]> {
    // fetch products from api
    // api route is defined in config/api.js
    return fetch(`/api/v1/products`, { mode: 'cors' })
      .then((res) => res.json())
      .then((data: IProduct[]) => {
        data.map((product: IProduct) => {
          product.currency = CURRENCY_SYMBOL[product.currency as Currency];
          product.type = product.type.toUpperCase();
          product.unit =
            product.unit.charAt(0).toUpperCase() + product.unit.slice(1);
          return product;
        });
        return data;
      });
  }

  /**
   * Get product by id.
   *
   * @param {number} id
   * @returns {Promise<IProduct>}
   */
  public static async getProductById(id: number): Promise<IProduct> {
    // fetch product from api
    // api route is defined in config/api.js
    return fetch(`/api/v1/products/${id}`, { mode: 'cors' })
      .then((res) => res.json())
      .then((data: IProduct) => {
        return data;
      });
  }

  /**
   * Create product.
   *
   * @param {IProduct} product
   * @returns {Promise<IProduct>}
   */

  public static async createProduct(product: IProduct): Promise<IProduct> {
    // fetch product from api
    // api route is defined in config/api.js
    return fetch(`/api/v1/products/`, {
      mode: 'cors',
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(product),
    })
      .then((res) => res.json())
      .then((data: IProduct) => {
        return data;
      });
  }

  /**
   * Update product.
   *
   * @param {IProduct} product
   * @returns {Promise<IProduct>}
   */

  public static async updateProduct(product: IProduct): Promise<IProduct> {
    // fetch product from api
    // api route is defined in config/api.js
    return fetch(`/api/v1/products/${product.id}`, {
      mode: 'cors',
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(product),
    })
      .then((res) => res.json())
      .then((data: IProduct) => {
        return data;
      });
  }

  /**
   * Delete product.
   *
   * @param {number} id
   * @returns {Promise<IProduct>}
   * @memberof ProductProvider
   */
  public static async deleteProduct(id: number): Promise<IProduct> {
    // fetch product from api
    // api route is defined in config/api.js
    return fetch(`/api/v1/products/${id}`, {
      mode: 'cors',
      method: 'DELETE',
    })
      .then((res) => res.json())
      .then((data: IProduct) => {
        return data;
      });
  }
}
