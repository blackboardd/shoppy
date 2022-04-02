import {
  CURRENCY_SYMBOL,
  IProduct,
} from '@/features/product/components/interface';
import * as config from '@/config/api';
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
    return fetch(`${config.API_URL}/products`)
      .then((res) => res.json())
      .then((data: IProduct[]) => {
        data.map((product: IProduct) => {
          product.currency = CURRENCY_SYMBOL[product.currency as Currency];
          product.type = product.type.toUpperCase();
          product.unit = product.unit.toUpperCase();
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
    return fetch(`${config.API_URL}/products/${id}`)
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
    return fetch(`${config.API_URL}/products/`, {
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
    return fetch(`${config.API_URL}/products/${product.product_id}`, {
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
    return fetch(`${config.API_URL}/products/${id}`, {
      method: 'DELETE',
    })
      .then((res) => res.json())
      .then((data: IProduct) => {
        return data;
      });
  }
}
